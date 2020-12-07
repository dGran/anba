<?php

namespace App\Http\Livewire\Admin;

use App\Models\AdminLog;
use App\Models\User;
use Livewire\Component;
use Livewire\withPagination;
use App\Exports\AdminLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminLogCrud extends Component
{
	use WithPagination;

	public $firstRender = true;

	//model info
	public $modelSingular = "log";
	public $modelPlural = "logs";
	public $modelGender = "male";
	public $modelHasImg = false;

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterType = "all";
	public $filterUser = "all";
	public $filterTable = "all";
	public $order = 'id_desc';

	// preferences vars
	public $showTableImages;
	public $striped;
	public $fixedFirstColumn;
	public $colType;
	public $colTable;
	public $colUser;
	public $colDate;

	// general vars
	public $currentModal;
	public $regView;

	//selected regs
	public $regsSelectedArray = [];
	public $checkAllSelector = 0;

	//import & export
	public $formatExport = '';
	public $filenameExportTable = '';
	public $filenameExportSelected = '';

	// queryString
	protected $queryString = [
		'search' => ['except' => ''],
		'filterType' => ['except' => "all"],
		'filterUser' => ['except' => "all"],
		'filterTable' => ['except' => "all"],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'admin_logs.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'admin_logs.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'admin_logs.striped' => $this->striped ? 'on' : 'off',
			'admin_logs.colType' => $this->colType ? 'on' : 'off',
			'admin_logs.colTable' => $this->colTable ? 'on' : 'off',
			'admin_logs.colUser' => $this->colUser ? 'on' : 'off',
			'admin_logs.colDate' => $this->colDate ? 'on' : 'off',
		]);

		if (!$this->colType && !$this->colTable && !$this->colUser && !$this->colDate) {
			session(['admin_logs.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('admin_logs.showTableImages')) {
			$this->showTableImages = session()->get('admin_logs.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('admin_logs.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('admin_logs.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}
		if (session()->get('admin_logs.striped')) {
			$this->striped = session()->get('admin_logs.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('admin_logs.colType')) {
			$this->colType = session()->get('admin_logs.colType') == 'on' ? true : false;
		} else {
			$this->colType = true;
		}
		if (session()->get('admin_logs.colTable')) {
			$this->colTable = session()->get('admin_logs.colTable') == 'on' ? true : false;
		} else {
			$this->colTable = true;
		}
		if (session()->get('admin_logs.colUser')) {
			$this->colUser = session()->get('admin_logs.colUser') == 'on' ? true : false;
		} else {
			$this->colUser = true;
		}
		if (session()->get('admin_logs.colDate')) {
			$this->colDate = session()->get('admin_logs.colDate') == 'on' ? true : false;
		} else {
			$this->colDate = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//filters
			'admin_logs.search' => $this->search,
			'admin_logs.perPage' => $this->perPage,
			'admin_logs.filterType' => $this->filterType,
			'admin_logs.filterUser' => $this->filterUser,
			'admin_logs.filterTable' => $this->filterTable,
			'admin_logs.order' => $this->order,
			'admin_logs.page' => $this->page,
			'admin_logs.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'admin_logs.currentModal' => $this->currentModal,
			//selected regs
			'admin_logs.regsSelectedArray' => $this->regsSelectedArray,
			'admin_logs.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//filters
		if (session()->get('admin_logs.search')) { $this->search = session()->get('admin_logs.search'); }
		if (session()->get('admin_logs.perPage')) { $this->perPage = session()->get('admin_logs.perPage'); }
		if (session()->get('admin_logs.filterType')) { $this->filterType = session()->get('admin_logs.filterType'); }
		if (session()->get('admin_logs.filterUser')) { $this->filterUser = session()->get('admin_logs.filterUser'); }
		if (session()->get('admin_logs.filterTable')) { $this->filterTable = session()->get('admin_logs.filterTable'); }
		if (session()->get('admin_logs.order')) { $this->order = session()->get('admin_logs.order'); }
		if (session()->get('admin_logs.page')) { $this->page = session()->get('admin_logs.page'); }
		if (session()->get('admin_logs.regsSelectedArray')) { $this->regsSelectedArray = session()->get('admin_logs.regsSelectedArray'); }
		// general vars
		if (session()->get('admin_logs.currentModal')) { $this->currentModal = session()->get('admin_logs.currentModal'); }
		//selected regs
		if (session()->get('admin_logs.regsSelectedArray')) { $this->regsSelectedArray = session()->get('admin_logs.regsSelectedArray'); }
		if (session()->get('admin_logs.checkAllSelector')) { $this->checkAllSelector = session()->get('admin_logs.checkAllSelector'); }
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
    		->name($this->search)
    		->type($this->filterType)
    		->user($this->filterUser)
    		->table($this->filterTable)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('admin_logs.id', 'desc')
			->paginate($this->perPage)->onEachSide(2);
		foreach ($regs as $reg) {
			if ($this->checkAllSelector == 1) {
				$this->regsSelectedArray[$reg->id] = $reg->id;
			} else {
				$array_id = array_search($reg->id, $this->regsSelectedArray);
				unset($this->regsSelectedArray[$array_id]);
			}
		}
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
    	$this->perPage = '10';
    }

    public function clearAllFilters()
    {
    	$this->search = '';
    	$this->page = 1;
    	$this->perPage = '10';
		$this->order = 'id_desc';
		$this->filterType = "all";
		$this->filterUser = "all";
		$this->filterTable = "all";

		$this->emit('resetFiltersMode');
    }

    // Destroy
    public function confirmDestroy()
    {
		if (count($this->regsSelectedArray) > 0) {
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
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
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
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('admin_logs.id', 'desc')
        	->get();
        $regs->makeHidden(['user_name', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new AdminLogsExport($regs), $filename . '.' . $this->formatExport);
    }

    // Pagination
    public function setNextPage()
    {
    	$this->page++;
    }

    public function setPreviousPage()
    {
		$this->page--;
    }


    // Render
    public function render()
    {
    	// Load Session Preferences
    	$this->getSessionPreferences();

    	// Load Session Filters
    	if ($this->firstRender) {
    		$this->getSessionState();
    		$firstRenderSaved = true;
    		$this->firstRender = false;
    	} else {
    		$firstRenderSaved = false;
    	}
    	$this->setSessionState();

    	$users = User::orderBy('name', 'asc')->get();
    	$types = AdminLog::select('type')->distinct()->whereNotNull('type')->orderBy('type', 'asc')->get();
    	$tables = AdminLog::select('table')->distinct()->whereNotNull('table')->orderBy('table', 'asc')->get();

        return view('livewire.admin.admin_logs', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'users' => $users,
        			'types' => $types,
        			'tables' => $tables,
        			'filterUserName' => $this->filterUserName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->type($this->filterType)
    		->user($this->filterUser)
    		->table($this->filterTable)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
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
    		->name($this->search)
    		->type($this->filterType)
    		->user($this->filterUser)
    		->table($this->filterTable)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
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
    		->type($this->filterType)
    		->user($this->filterUser)
    		->table($this->filterTable)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('admin_logs.id', 'desc')
			->paginate($this->perPage, ['*'], 'page', $this->page);

		$this->checkAllSelector = 1;
		foreach ($regs as $Conference) {
			$array_id = array_search($Conference->id, $this->regsSelectedArray);
			if (!$array_id) {
				$this->checkAllSelector = 0;
			}
		}
	}

	protected function getDataSelected()
	{
		return AdminLog::
    		leftJoin('users', 'users.id', 'admin_logs.user_id')
    		->select('admin_logs.*', 'users.name as user_name')
			->whereIn('admin_logs.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('admin_logs.id', 'desc')
			->get();
	}

	protected function filterUserName()
	{
		if ($this->filterUser != "all") {
			return User::find($this->filterUser)->name;
		}
	}

    protected function getOrder($order) {
        $order_ext = [
            'id' => [
                'field'     => 'id',
                'direction' => 'asc'
            ],
            'id_desc' => [
                'field'     => 'id',
                'direction' => 'desc'
            ],
            'name' => [
                'field'     => 'admin_logs.reg_name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'admin_logs.reg_name',
                'direction' => 'desc'
            ],
            'type' => [
                'field'     => 'admin_logs.type',
                'direction' => 'asc'
            ],
            'type_desc' => [
                'field'     => 'admin_logs.type',
                'direction' => 'desc'
            ],
            'table' => [
                'field'     => 'admin_logs.table',
                'direction' => 'asc'
            ],
            'table_desc' => [
                'field'     => 'admin_logs.table',
                'direction' => 'desc'
            ],
            'user' => [
                'field'     => 'users.name',
                'direction' => 'asc'
            ],
            'user_desc' => [
                'field'     => 'users.name',
                'direction' => 'desc'
            ],
            'date' => [
                'field'     => 'admin_logs.created_at',
                'direction' => 'asc'
            ],
            'date_desc' => [
                'field'     => 'admin_logs.created_at',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'admin_logs.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}
