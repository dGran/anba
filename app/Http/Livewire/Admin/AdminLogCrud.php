<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use App\Enum\EventNames;
use App\Enum\LivewireQueryString;
use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Http\Livewire\Base\BaseComponent;
use App\Managers\AdminLogManager;
use App\Managers\UserManager;
use App\Models\AdminLog;
use App\Services\SessionService;
use App\Services\TableInfoService;
use App\Services\TableFiltersService;
use App\Exports\AdminLogsExport;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AdminLogCrud extends BaseComponent
{
	public AdminLog $regView;

    public ?string $order = 'id_desc';

	//import & export
    // TODO: sustituir por export/import .csv (Box Spout¿? algo nativo de PHP¿? algo nativo de Laravel¿?)
	public string $formatExport = '';
	public string $filenameExportTable = '';
    public string $filenameExportSelected = '';

    protected $queryString = [
        LivewireQueryString::NAME_SEARCH => ['except' => TableFilters::VALUE_NULL_STRING],
        LivewireQueryString::NAME_FILTER_TYPE => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_FILTER_USER => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_FILTER_TABLE => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_PER_PAGE => ['except' => TableFilters::PER_PAGE_DEFAULT_VALUE],
        LivewireQueryString::NAME_ORDER_BY => ['except' => OrderByCriteria::ORDER_BY_ID_DESC],
    ];

    private TableInfoService $tableInfoService;

    private TableFiltersService $tableFiltersService;

    private AdminLogManager $adminLogManager;

    private UserManager $userManager;

    private SessionService $sessionService;

    private string $tableName = 'admin_logs';

    private LengthAwarePaginator $data;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function boot(
        TableInfoService $tableInfoService,
        TableFiltersService $tableFiltersService,
        AdminLogManager $adminLogManager,
        UserManager $userManager,
        SessionService $sessionService
    ): void {
        $this->tableInfoService = $tableInfoService;
        $this->tableFiltersService = $tableFiltersService;
        $this->adminLogManager = $adminLogManager;
        $this->userManager = $userManager;
        $this->sessionService = $sessionService;

        $this->tableInfo = $this->tableInfoService->getTableInfoByTableName($this->tableName);
        $this->optionProperties = $this->sessionService->getOptionPropertiesByTableName($this->tableName);
        $this->filterProperties = $this->sessionService->getFilterPropertiesByTableName($this->tableName);
        $this->initializeOptions($this->tableName);
        $this->initializeFilters();
    }

    public function render()
    {
        $this->setPropertiesInSession($this->filterProperties, $this->tableName);
        $this->setPropertiesInSession($this->optionProperties, $this->tableName);

        $this->getData();
        $this->handleSelection();

        return view('admin.admin_logs', [
            'data' => $this->data,
            'selectedData' => $this->getSelectedData(),
        ])->layout('adminlte::page');
    }

    public function view($id): void
    {
        $this->regView = $this->adminLogManager->findOneById($id);
        $this->dispatchEvent(EventNames::NAME_OPEN_VIEW_MODAL);
    }

    public function destroy(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        $countDeleted = 0;

        foreach ($this->selectedIds as $id) {
            $reg = $this->adminLogManager->findOneById($id);

            if ($reg === null) {
                continue;
            }

            if ($reg->canDestroy()) {
                try {
                    $reg->delete();
                    $countDeleted++;
                } catch (\Throwable $exception) {
                }
            }
        }

        $this->selectedIds = TableFilters::VALUE_EMPTY_ARRAY;
        $this->sessionService->flashDestroyFromSelectedIds($countDeleted, \count($this->selectedIds));
        $this->dispatchEvent(EventNames::NAME_CLOSE_DESTROY_MODAL);
    }

    public function select(int $id): void
    {
        if (isset($this->selectedIds[$id])) {
            unset($this->selectedIds[$id]);
            $this->isCheckAllSelector = false;

            return;
        }

        $this->selectedIds[$id] = $id;
    }

    public function checkAll(): void
    {
        $this->getData();
        $ids = $this->getIdsIndexedByIdFromData();

        foreach ($ids as $id) {
            if ($this->isCheckAllSelector) {
                unset($this->selectedIds[$id]);

                continue;
            }

            $this->selectedIds[$id] = $id;
        }
	}

    public function cancelSelection(): void
    {
        $this->selectedIds = TableFilters::VALUE_EMPTY_ARRAY;
        $this->dispatchEvent(EventNames::NAME_CLOSE_SELECTED_MODAL);
    }

	public function viewSelected($view): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        if ($view === null) {
            $this->dispatchEvent(EventNames::NAME_CLOSE_SELECTED_MODAL);
        }

        $this->dispatchEvent(EventNames::NAME_OPEN_SELECTED_MODAL);
	}

    protected function getSelectedData()
    {
        return AdminLog::
        leftJoin('users', 'users.id', 'admin_logs.user_id')
            ->select('admin_logs.*', 'users.name as user_name')
            ->whereIn('admin_logs.id', $this->selectedIds)
            ->orderBy($this->orderByColumn, $this->orderByOrder)
            ->orderBy('admin_logs.id', 'desc')
            ->get();
    }






    public function resetFilters(): void
    {
        $this->resetCommonFilters($this->tableName, $this->tableInfo);
    }

    /**
     * Computed Property
     */
    public function getFiltersAppliedProperty(): bool
    {
        return !(
            $this->orderBy === BaseComponent::PROPERTY_INITIAL_VALUES[TableFilters::NAME_ORDER_BY]
            && $this->search === BaseComponent::PROPERTY_INITIAL_VALUES[TableFilters::NAME_SEARCH]
            && $this->type === BaseComponent::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TYPE]
            && $this->table === BaseComponent::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TABLE]
            && $this->user === BaseComponent::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER]
            && $this->perPage === BaseComponent::PROPERTY_INITIAL_VALUES[TableFilters::NAME_PER_PAGE]
        );
    }

	public function viewFilters($view): void
    {
		if ($view) {
			$this->dispatchEvent(EventNames::NAME_OPEN_FILTERS_MODAL);
		} else {
			$this->dispatchEvent(EventNames::NAME_CLOSE_FILTERS_MODAL);
		}
	}

    public function setFilterPerPage($number): void
    {
    	$this->perPage = $number;
    }


    //Export & Import
    public function confirmExportTable($format)
    {
    	$this->formatExport = $format;
		$this->dispatchEvent(EventNames::NAME_OPEN_EXPORT_TABLE_MODAL);
    }

    public function tableExport()
    {
    	$this->dispatchEvent(EventNames::NAME_CLOSE_EXPORT_TABLE_MODAL);

    	$filename = $this->filenameExportTable ?: 'logs';

    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->type($this->type)
    		->user($this->user)
    		->table($this->table)
            ->orderBy($this->orderByColumn, $this->orderByOrder)
			->orderBy('admin_logs.id', 'desc')
    		->get();

		$regs->makeHidden(['user_name', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new AdminLogsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->dispatchEvent(EventNames::NAME_OPEN_EXPORT_SELECTED_MODAL);
    }

    public function selectedExport()
    {
    	$this->dispatchEvent(EventNames::NAME_CLOSE_EXPORT_SELECTED_MODAL);

    	$filename = $this->filenameExportSelected ?: 'logs_seleccionados';

    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
    		->whereIn('admin_logs.id', $this->selectedIds)
			->orderBy($this->orderByColumn, $this->orderByOrder)
			->orderBy('admin_logs.id', 'desc')
        	->get();
        $regs->makeHidden(['user_name', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new AdminLogsExport($regs), $filename . '.' . $this->formatExport);
    }





	public function getUserNameByUser(): void
	{
        if ($this->user === TableFilters::VALUE_ALL) {
            return;
        }

        $user = $this->userManager->findOneById((int)$this->user);

        if ($user === null) {
            $this->user = TableFilters::VALUE_ALL;

            return;
        }

        $this->userName = $user->getName();
	}

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function initializeFilters(): void
    {
        $this->initializeCommonFilters($this->tableName, $this->tableInfo);

        $userNamesIndexedById = $this->adminLogManager->getDistinctUsers();
        $this->relatedUsers = $userNamesIndexedById;

        $tables = $this->adminLogManager->getDistinctTables();
        $this->relatedTables = $tables;

        $types = $this->adminLogManager->getDistinctTypes();
        $this->relatedTypes = $types;
    }

    private function getData(): void
    {
        $this->data = $this->adminLogManager->commandFilter(
            $this->search,
            $this->type,
            $this->userName,
            $this->table,
            $this->perPage,
            $this->orderByColumn,
            $this->orderByOrder
        );

        if ($this->page !== 1 && $this->data->total() > 0 && $this->data->isEmpty()) {
            $this->previousPage();
        }
    }

    private function handleSelection(): void
    {
        $this->isCheckAllSelector = !\array_diff($this->getIdsIndexedByIdFromData(), $this->selectedIds);
    }

    /**
     * @return int[]
     */
    private function getIdsIndexedByIdFromData(): array
    {
        return $this->data->pluck('id', 'id')->toArray();
    }
}
