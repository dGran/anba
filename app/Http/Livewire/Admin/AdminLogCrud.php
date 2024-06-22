<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use App\Enum\LivewireQueryString;
use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Enum\TableOptions;
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
	// general vars
	public $regView;

	//import & export
    // TODO: sustituir por export/import .csv (Box Spout¿? algo nativo de PHP¿? algo nativo de Laravel¿?)
	public string $formatExport = '';
	public string $filenameExportTable = '';
    public string $filenameExportSelected = '';


    public ?string $order = 'id_desc';

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

        return view('admin.admin_logs', [
            'data' => $this->getData(),
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

	// Selected
	public function checkSelected($id): void
    {
        $selectedIds = $this->viewModel->getTableOptions()->getSelectedIds();
		$id = \array_search($id, $selectedIds, true);

		if (!$id) {
            $selectedIds[$id] = $id;
		} else {
			unset($selectedIds[$id]);
		}

        $this->viewModel->getTableOptions()->setSelectedIds($selectedIds);
	}

	public function checkAll()
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
			->paginate($this->tableFiltersDTO->getPerPage())->onEachSide(2);

        $selectedIds = [];

		foreach ($regs as $reg) {
			if ($this->tableOptionsDTO->isCheckAllSelector()) {
                $selectedIds[$reg->id] = $reg->id;
			} else {
				$array_id = \array_search($reg->id, $this->regsSelectedArray);
				unset($this->tableOptionsDTO->getSelectedIds()[$array_id]);
			}
		}

        $this->tableOptionsDTO->setSelectedIds($selectedIds);
	}

	public function deselect($id)
	{
		$array_id = array_search($id, $this->regsSelectedArray);
		unset($this->regsSelectedArray[$array_id]);

		if (empty($this->regsSelectedArray)) {
			$this->emit('closeSelectedModal');
		}
	}

	public function cancelSelection()
	{
		$this->regsSelectedArray = [];
		$this->emit('closeSelectedModal');
	}

	public function viewSelected($view)
	{
		if (count($this->regsSelectedArray) > 0) {
			if ($view) {
				$this->emit('openSelectedModal');
			} else {
				$this->emit('closeSelectedModal');
			}
		}
	}

	// Filters
    public function order($name)
    {
    	$this->order = $name;
    	$this->page = 1;
    }

	public function viewFilters($view): void
    {
		if ($view) {
			$this->emit('openFiltersModal');
		} else {
			$this->emit('closeFiltersModal');
		}
	}

    public function cancelFilterSearch(): void
    {
    	$this->search = '';
    }

    public function cancelFilterType()
    {
		$this->type = "all";
    }

    public function cancelFilterUser()
    {
		$this->user = "all";
    }

    public function clearFilter(string $property): void
    {
//        $this->{$property} =
    }

    public function cancelFilterTable()
    {
		$this->table = "all";
    }

    public function setFilterPerPage($number): void
    {
    	$this->perPage = $number;
    }

    public function cancelFilterPerPage()
    {
    	$this->perPage = '25';
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function resetFilters(): void
    {
        $this->initializeFilters();
		$this->emit('resetFiltersMode');
    }

    // Destroy
    public function confirmDestroy()
    {
		if (\count($this->regsSelectedArray) > 0) {
			$this->emit('openDestroyModal');
		}
    }

    public function destroy()
    {
    	$regs_to_delete = count($this->regsSelectedArray);
		$regs_deleted = 0;

		foreach ($this->regsSelectedArray as $reg) {
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

		$this->regsSelectedArray = [];
    }

    // View
    public function view($id)
    {
    	$this->regView = AdminLog::find($id);
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
    		->whereIn('admin_logs.id', $this->regsSelectedArray)
			->orderBy($this->orderByColumn, $this->orderByOrder)
			->orderBy('admin_logs.id', 'desc')
        	->get();
        $regs->makeHidden(['user_name', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new AdminLogsExport($regs), $filename . '.' . $this->formatExport);
    }

	protected function getData()
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

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}

		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
//            ->name($this->search)
//            ->type($this->type)
//            ->user($this->user)
//            ->table($this->table)
            ->orderBy($this->orderByColumn, $this->orderByOrder)
			->orderBy('admin_logs.id', 'desc')
            ->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();

		return $regs;
	}

	protected function setCheckAllSelector()
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
			->paginate($this->perPage, ['*'], 'page', $this->page);

        $this->isCheckAllSelector = true;

		foreach ($regs as $conference) {
			$array_id = \array_search($conference->id, $this->selectedIds, true);

			if (!$array_id) {
                $this->isCheckAllSelector = false;
            }
		}
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

	protected function getFilterUserName(): string
	{
        if ($this->tableFiltersDTO->getUser() !== 'all') {
            return '';
        }

        $userId = $this->tableFiltersDTO->getUser();
        $user = $this->userManager->findOneById($userId);

        if ($user === null) {
            $this->tableFiltersDTO->setUser('all');

            return '';
        }

        return $user->getName();
	}

    public function setCurrentModal($modal): void
    {
        $currentModal = $modal;
        $this->sessionService->set($this->tableName, TableOptions::NAME_CURRENT_MODAL, $modal);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function initializeFilters(): void
    {
        $this->initializeCommonFilters($this->tableName, $this->tableInfo);

        $userIds = $this->adminLogManager->getDistinctUsers();
        $this->relatedUsers = $userIds;

        $tables = $this->adminLogManager->getDistinctTables();
        $this->relatedTables = $tables;

        $types = $this->adminLogManager->getDistinctTypes();
        $this->relatedTypes = $types;
    }
}
