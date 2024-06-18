<?php

namespace App\Http\Livewire\Admin;

use App\DTO\TableDataDTO;
use App\Enum\LivewireQueryString;
use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Factories\ViewModels\AdminLogCrudFactory;
use App\Managers\AdminLogManager;
use App\Managers\UserManager;
use App\Models\AdminLog;
use App\Services\SessionService;
use App\Services\TableDataService;
use App\Services\TableFiltersService;
use App\Services\TableOptionsService;
use App\ViewModels\CrudViewModel;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\AdminLogsExport;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AdminLogCrud extends Component
{
	use WithPagination;

	// general vars
	public $regView;

	//import & export
    // TODO: sustituir por export/import .csv (Box Spout¿? algo nativo de PHP¿? algo nativo de Laravel¿?)
	public string $formatExport = '';
	public string $filenameExportTable = '';
    public string $filenameExportSelected = '';

    public array $tableData;

    public array $tableFilters;

    public array $tableOptions;

    public ?string $search = null;

    public ?string $type = null;

    public ?string $user = null;

    public ?string $table = null;

    public ?string $perPage = null;

    public ?string $order = null;

    protected $queryString = [
        LivewireQueryString::NAME_SEARCH => ['except' => TableFilters::VALUE_NULL],
        LivewireQueryString::NAME_FILTER_TYPE => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_FILTER_USER => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_FILTER_TABLE => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_PER_PAGE => ['except' => TableFilters::VALUE_PER_PAGE_DEFAULT],
        LivewireQueryString::NAME_ORDER => ['except' => OrderByCriteria::ORDER_BY_ID_DESC],
    ];

    private AdminLogManager $adminLogManager;

    private UserManager $userManager;

    private SessionService $sessionService;

    private TableDataService $tableDataService;

    private TableFiltersService $tableFiltersService;

    private TableOptionsService $tableOptionsService;

    private AdminLogCrudFactory $adminLogCrudFactory;

    private string $tableName = 'admin_logs';

    private CrudViewModel $viewModel;

    /**
     * @throws \JsonException
     */
    public function boot(
        AdminLogManager $adminLogManager,
        UserManager $userManager,
        SessionService $sessionService,
        TableFiltersService $tableFiltersService,
        TableDataService $tableDataService,
        TableOptionsService $tableOptionsService,
        AdminLogCrudFactory $adminLogCrudFactory
    ): void {
        $this->adminLogManager = $adminLogManager;
        $this->userManager = $userManager;
        $this->sessionService = $sessionService;
        $this->tableDataService = $tableDataService;
        $this->tableFiltersService = $tableFiltersService;
        $this->tableOptionsService = $tableOptionsService;
        $this->adminLogCrudFactory = $adminLogCrudFactory;

        $this->viewModel = $this->adminLogCrudFactory->create($this->tableName);

//        $this->initializeFromSession();
    }

    public function mount(): void
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \JsonException
     */
    public function render()
    {
        //table data se inicializa y no se tiene que editar
        $this->tableData = $this->tableDataService->toArray($this->viewModel->getTableData());

        //tableFilters y tableOptions se inicializan y sí se van actualizando según la acción del usuario
        $this->tableFilters = $this->tableFiltersService->toArray($this->viewModel->getTableFilters());
        $this->tableOptions = $this->tableOptionsService->toArray($this->viewModel->getTableOptions());

        //TODO: todas las acciones las vamos a realizar sobre el viewModel y en el render vamos a pasar a la vista el modelo en array separado por variables

        $this->sessionService->setOptionValues($this->tableName, $this->viewModel->getTableOptions());
        $this->sessionService->setFilterValues($this->tableName, $this->viewModel->getTableFilters());

        return view('admin.admin_logs', [
            'tableData' => $this->tableData,
            'filters' => $this->tableFilters,
            'options' => $this->tableOptions,
            'data' => $this->getData(),
            'selectedData' => $this->getSelectedData(),
            'users' => $this->tableFilters['relatedUserIds'],
            'types' => $this->tableFilters['relatedTypes'],
            'tables' => $this->tableFilters['relatedTables'],
            'currentModal' => $this->tableOptions['currentModal'],
        ])->layout('adminlte::page');
    }

	public function setSessionPreferences(): void
    {
        $this->sessionService->setOptionValues($this->tableName, $this->tableOptionsDTO);
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

		if (session()->get('admin_logs.striped')) {
			$this->striped = session()->get('admin_logs.striped') === 'on';
		} else {
			$this->striped = true;
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

    // TODO: mover a un servicio
	protected function initializeFromSession(): void
    {
		//filters
        if (session()->get('admin_logs.search')) {
            $this->search = session()->get('admin_logs.search');
        }

        if (session()->get('admin_logs.perPage')) {
            $this->perPage = session()->get('admin_logs.perPage');
        }

        if (session()->get('admin_logs.filterType')) {
            $this->filterType = session()->get('admin_logs.filterType');
        }

        if (session()->get('admin_logs.filterUser')) {
            $this->filterUser = session()->get('admin_logs.filterUser');
        }

        if (session()->get('admin_logs.filterTable')) {
            $this->filterTable = session()->get('admin_logs.filterTable');
        }

        if (session()->get('admin_logs.order')) {
            $this->order = session()->get('admin_logs.order');
        }

        if (session()->get('admin_logs.page')) {
            $this->page = session()->get('admin_logs.page');
        }

        if (session()->get('admin_logs.regsSelectedArray')) {
            $this->regsSelectedArray = session()->get('admin_logs.regsSelectedArray');
        }

		// general vars
        if (session()->get('admin_logs.currentModal')) {
            $this->currentModal = session()->get('admin_logs.currentModal');
        }

		//selected regs
        if (session()->get('admin_logs.regsSelectedArray')) {
            $this->regsSelectedArray = session()->get('admin_logs.regsSelectedArray');
        }

        if (session()->get('admin_logs.checkAllSelector')) {
            $this->isCheckAllSelector = session()->get('admin_logs.checkAllSelector');
        }
	}

	// Selected
	public function checkSelected($id)
	{
		$array_id = array_search($id, $this->regsSelectedArray);

		if (!$array_id) {
			$this->regsSelectedArray[$id] = $id;
		} else {
			unset($this->regsSelectedArray[$array_id]);
		}
	}

	public function checkAll()
	{
    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
    		->name($this->tableFiltersDTO->getSearch())
    		->type($this->tableFiltersDTO->getType())
    		->user($this->tableFiltersDTO->getUser())
    		->table($this->tableFiltersDTO->getTable())
			->orderBy($this->getOrder()->getDetail()->getFieldName(), $this->getOrder()->getDetail()->getDirection())
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

	public function viewFilters($view)
	{
		if ($view) {
			$this->emit('openFiltersModal');
		} else {
			$this->emit('closeFiltersModal');
		}
	}

    public function cancelFilterSearch()
    {
    	$this->search = '';
    }

    public function cancelFilterType()
    {
		$this->filterType = "all";
    }

    public function cancelFilterUser()
    {
		$this->filterUser = "all";
    }

    public function cancelFilterTable()
    {
		$this->filterTable = "all";
    }

    public function setFilterPerPage($number)
    {
    	$this->perPage = $number;
    }

    public function cancelFilterPerPage()
    {
    	$this->perPage = '25';
    }

    /**
     * @throws \JsonException
     */
    public function resetFilters()
    {
        $initTableFiltersDTO = $this->tableFiltersService->initialize($this->tableName);
        $this->viewModel->setTableFilters($initTableFiltersDTO);

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
    		->type($this->filterType)
    		->user($this->filterUser)
    		->table($this->filterTable)
			->orderBy($this->getOrder($this->tableFiltersDTO->getOrder())['field'], $this->getOrder($this->tableFiltersDTO->getOrder())['direction'])
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
			->orderBy($this->getOrder($this->tableFiltersDTO->getOrder())['field'], $this->getOrder($this->tableFiltersDTO->getOrder())['direction'])
			->orderBy('admin_logs.id', 'desc')
        	->get();
        $regs->makeHidden(['user_name', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new AdminLogsExport($regs), $filename . '.' . $this->formatExport);
    }

    private function getOrderByColumn(): string
    {
        $orderName = $this->viewModel->getTableFilters()->getOrder();
        $orderByCriteriaIndexedByName = $this->viewModel->getTableData()->getOrderByCriteriaIndexedByName();
        $orderBy = $orderByCriteriaIndexedByName[$orderName];

        return $orderBy['column'];
    }

    private function getOrderByOrder(): string
    {
        $orderName = $this->viewModel->getTableFilters()->getOrder();
        $orderByCriteriaIndexedByName = $this->viewModel->getTableData()->getOrderByCriteriaIndexedByName();
        $orderBy = $orderByCriteriaIndexedByName[$orderName];

        return $orderBy['order'];
    }

	protected function getData()
	{
    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
    		->name($this->viewModel->getTableFilters()->getSearch())
    		->type($this->viewModel->getTableFilters()->getType())
    		->user($this->viewModel->getTableFilters()->getUser())
    		->table($this->viewModel->getTableFilters()->getTable())
			->orderBy($this->getOrderByColumn(), $this->getOrderByOrder())
			->orderBy('admin_logs.id', 'desc')
			->paginate($this->viewModel->getTableFilters()->getPerPage())->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}

		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
            ->name($this->viewModel->getTableFilters()->getSearch())
            ->type($this->viewModel->getTableFilters()->getType())
            ->user($this->viewModel->getTableFilters()->getUser())
            ->table($this->viewModel->getTableFilters()->getTable())
            ->orderBy($this->getOrderByColumn(), $this->getOrderByOrder())
			->orderBy('admin_logs.id', 'desc')
            ->paginate($this->viewModel->getTableFilters()->getPerPage())->onEachSide(2);

        $this->setCheckAllSelector();

		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
            ->name($this->viewModel->getTableFilters()->getSearch())
            ->type($this->viewModel->getTableFilters()->getType())
            ->user($this->viewModel->getTableFilters()->getUser())
            ->table($this->viewModel->getTableFilters()->getTable())
            ->orderBy($this->getOrderByColumn(), $this->getOrderByOrder())
            ->orderBy('admin_logs.id', 'desc')
			->paginate($this->viewModel->getTableFilters()->getPerPage(), ['*'], 'page', $this->page);

		$this->isCheckAllSelector = true;

		foreach ($regs as $Conference) {
			$array_id = array_search($Conference->id, $this->regsSelectedArray);
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
			->whereIn('admin_logs.id', $this->viewModel->getTableOptions()->getSelectedIds())
            ->orderBy($this->getOrderByColumn(), $this->getOrderByOrder())
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

    public function getOrder(): OrderDTO
    {
        $orderName = $this->viewModel->getTableFilters()->getOrder();

        return $this->viewModel->getTableData()->getOrders()[$orderName];
    }

	public function setCurrentModal($modal): void
    {
        $this->viewModel->getTableOptions()->setCurrentModal($modal);
        $this->sessionService->setOptionValues($this->tableName, $this->tableOptionsDTO);
	}

	public function closeAnyModal(): void
    {
        $this->tableOptionsDTO->setCurrentModal(null);
	}

    public function setNextPage(): void
    {
        $this->page++;
    }

    public function setPreviousPage(): void
    {
        $this->page--;
    }
}
