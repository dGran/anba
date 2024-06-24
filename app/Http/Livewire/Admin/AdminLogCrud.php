<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

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
        LivewireQueryString::NAME_ORDER => ['except' => OrderByCriteria::ORDER_BY_ID_DESC],
    ];

    private TableInfoService $tableInfoService;

    private TableFiltersService $tableFiltersService;

    private AdminLogManager $adminLogManager;

    private UserManager $userManager;

    private SessionService $sessionService;

    private string $tableName = 'admin_logs';

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

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \JsonException
     */
    public function render()
    {
        $this->setPropertiesInSession($this->optionProperties, $this->tableName);
        $this->setPropertiesInSession($this->filterProperties, $this->tableName);

        $data = $this->getData();

        return view('admin.admin_logs', [
//            'data' => $this->getData(),
            'data' => $data,
            'selectedData' => $this->getSelectedData(),
        ])->layout('adminlte::page');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function handleSessionPreferences(): void
    {
        // TODO: mover a un servicio
		if (session()->get('admin_logs.showTableImages')) {
			$this->showTableImages = session()->get('admin_logs.showTableImages') === 'on';
		} else {
			$this->showTableImages = true;
		}

		if (session()->get('admin_logs.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('admin_logs.fixedFirstColumn') === 'on';
		} else {
			$this->fixedFirstColumn = true;
		}

		if (session()->get('admin_logs.isShowStriped')) {
			$this->isShowStriped = session()->get('admin_logs.isShowStriped') === 'on';
		} else {
			$this->isShowStriped = true;
		}

		if (session()->get('admin_logs.colType')) {
			$this->colType = session()->get('admin_logs.colType') === 'on';
		} else {
			$this->colType = true;
		}

		if (session()->get('admin_logs.colTable')) {
			$this->colTable = session()->get('admin_logs.colTable') === 'on';
		} else {
			$this->colTable = true;
		}

		if (session()->get('admin_logs.colUser')) {
			$this->colUser = session()->get('admin_logs.colUser') === 'on';
		} else {
			$this->colUser = true;
		}

		if (session()->get('admin_logs.colDate')) {
			$this->colDate = session()->get('admin_logs.colDate') === 'on';
		} else {
			$this->colDate = true;
		}
	}

	public function checkSelected(int $id): void
    {
        if (\array_key_exists($id, $this->selectedIds)) {
            unset($this->selectedIds[$id]);

            if ($this->isCheckAllSelector) {
                $this->isCheckAllSelector = false;
            }

            return;
        }

        $this->selectedIds[$id] = $id;
	}

	public function checkAll(): void
    {
    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
            ->name($this->search)
            ->type($this->type)
            ->user($this->user)
            ->table($this->table)
            ->orderBy($this->orderByColumn, $this->orderByOrder)
			->orderBy('admin_logs.id', 'desc')
            ->paginate($this->perPage)->onEachSide(2);

		foreach ($regs as $reg) {
            if (!$this->isCheckAllSelector) {
                $array_id = \array_search($reg->id, $this->selectedIds, true);
                unset($this->selectedIds[$array_id]);

                continue;
            }

            $this->selectedIds[$reg->id] = $reg->id;
		}
	}

	public function deselect($id): void
	{
		unset($this->selectedIds[$id]);

		if (empty($this->selectedIds)) {
			$this->emit('closeSelectedModal');
		}
	}

	public function cancelSelection()
	{
		$this->selectedIds = [];
		$this->emit('closeSelectedModal');
	}

	public function viewSelected($view): void
    {
        if (\count($this->selectedIds) === 0) {
            return;
        }

        if ($view === null) {
            $this->emit('closeSelectedModal');
        }

        $this->emit('openSelectedModal');
	}

	// Filters


	public function viewFilters($view): void
    {
		if ($view) {
			$this->emit('openFiltersModal');
		} else {
			$this->emit('closeFiltersModal');
		}
	}

    public function setFilterPerPage($number): void
    {
    	$this->perPage = $number;
    }

    // Destroy
    public function confirmDestroy()
    {
		if (\count($this->selectedIds) > 0) {
			$this->emit('openDestroyModal');
		}
    }

    public function destroy()
    {
    	$regs_to_delete = count($this->selectedIds);
		$regs_deleted = 0;

		foreach ($this->selectedIds as $reg) {
			if ($reg = AdminLog::find($reg)) {
				if ($reg->canDestroy()) {
					if ($reg->delete()) {
						$regs_deleted++;
					}
				}
			}
		}

		if ($regs_deleted > 0) {
			session()->flash('success', $regs_to_delete == 1 ? 'Registro eliminado correctamente!.' : 'Registros eliminados correctamente!.');
		} else {
			if ($regs_to_delete == 1) {
				session()->flash('error', 'El registro no puede ser eliminado o ya no existe.');
			} elseif ($regs_to_delete > 1) {
				session()->flash('error', 'No se ha eliminado ningún registro, no pueden ser eliminados o ya no existen.');
			}
		}

		$this->emit('closeDestroyModal');

		$this->selectedIds = [];
    }

    // View
    public function view($id): void
    {
        $this->regView = $this->adminLogManager->findOneById($id);
    	$this->emit('openViewModal');
    }

    //Export & Import
    public function confirmExportTable($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportTableModal');
    }

    public function tableExport()
    {
    	$this->emit('closeExportTableModal');

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
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

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

	protected function getData()
	{
        $regs = $this->adminLogManager->commandFilter($this->search, $this->type, $this->userName, $this->table, (int)$this->perPage, $this->orderByColumn, $this->orderByOrder);

	    if (($regs->total() > 0 && $regs->count() === 0)) {
			$this->page = 1;
		}

		if ($this->page === 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
            ->name($this->search)
            ->type($this->type)
            ->user($this->user)
            ->table($this->table)
            ->orderBy($this->orderByColumn, $this->orderByOrder)
			->orderBy('admin_logs.id', 'desc')
            ->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();

		return $regs;
	}

	protected function setCheckAllSelector(): void
    {
    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.id')
            ->name($this->search)
            ->type($this->type)
            ->user($this->user)
            ->table($this->table)
            ->orderBy($this->orderByColumn, $this->orderByOrder)
            ->orderBy('admin_logs.id', 'desc')
			->paginate($this->perPage, ['*'], 'page', $this->page)
            ->pluck('id')->toArray();


        if (empty(\array_diff($regs, $this->selectedIds))) {
            $this->isCheckAllSelector = true;

            return;
        }

        $this->isCheckAllSelector = false;
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

	public function getUserNameByUser(): void
	{
        if ($this->user === 'all') {
            return;
        }

        $user = $this->userManager->findOneById((int)$this->user);

        if ($user === null) {
            $this->user = 'all';

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

    public function resetFilters(): void
    {
        $this->resetCommonFilters($this->tableName, $this->tableInfo);
    }
}
