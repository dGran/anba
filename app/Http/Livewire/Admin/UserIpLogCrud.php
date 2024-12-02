<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\UserIpLog;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\UserIpLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class UserIpLogCrud extends Component
{
	use WithPagination;

	public $firstRender = true;

	//model info
	public $modelSingular = "user_ip_log";
	public $modelPlural = "user_ip_logs";
	public $modelGender = "male";
	public $modelHasImg = false;

	//filters
	public $search = "";
	public $perPage = '25';
	public $filterUser = "all";
	public $order = 'id_desc';

	// preferences vars
	public $showTableImages;
	public $striped;
	public $fixedFirstColumn;
    public $colUser;
    public $colLocation;
    public $colCounter;
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
		'filterUser' => ['except' => "all"],
		'perPage' => ['except' => '25'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'user_ip_logs.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'user_ip_logs.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'user_ip_logs.striped' => $this->striped ? 'on' : 'off',
			'user_ip_logs.colUser' => $this->colUser ? 'on' : 'off',
            'user_ip_logs.colLocation' => $this->colLocation ? 'on' : 'off',
            'user_ip_logs.colCounter' => $this->colCounter ? 'on' : 'off',
			'user_ip_logs.colDate' => $this->colDate ? 'on' : 'off',
		]);

		if (!$this->colUser && !$this->colLocation && !$this->colCounter && !$this->colDate) {
			session(['user_ip_logs.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('user_ip_logs.showTableImages')) {
			$this->showTableImages = session()->get('user_ip_logs.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}

		if (session()->get('user_ip_logs.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('user_ip_logs.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}

		if (session()->get('user_ip_logs.striped')) {
			$this->striped = session()->get('user_ip_logs.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}

		if (session()->get('user_ip_logs.colUser')) {
			$this->colUser = session()->get('user_ip_logs.colUser') == 'on' ? true : false;
		} else {
			$this->colUser = true;
		}

		if (session()->get('user_ip_logs.colLocation')) {
			$this->colLocation = session()->get('user_ip_logs.colLocation') == 'on' ? true : false;
		} else {
			$this->colLocation = true;
		}

		if (session()->get('user_ip_logs.colCounter')) {
			$this->colCounter = session()->get('user_ip_logs.colCounter') == 'on' ? true : false;
		} else {
			$this->colCounter = true;
		}

		if (session()->get('user_ip_logs.colDate')) {
			$this->colDate = session()->get('user_ip_logs.colDate') == 'on' ? true : false;
		} else {
			$this->colDate = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//filters
			'user_ip_logs.search' => $this->search,
			'user_ip_logs.perPage' => $this->perPage,
			'user_ip_logs.filterUser' => $this->filterUser,
			'user_ip_logs.order' => $this->order,
			'user_ip_logs.page' => $this->page,
			// general vars
			'user_ip_logs.currentModal' => $this->currentModal,
			//selected regs
			'user_ip_logs.regsSelectedArray' => $this->regsSelectedArray,
			'user_ip_logs.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//filters
		if (session()->get('user_ip_logs.search')) { $this->search = session()->get('user_ip_logs.search'); }
		if (session()->get('user_ip_logs.perPage')) { $this->perPage = session()->get('user_ip_logs.perPage'); }
		if (session()->get('user_ip_logs.filterUser')) { $this->filterUser = session()->get('user_ip_logs.filterUser'); }
		if (session()->get('user_ip_logs.order')) { $this->order = session()->get('user_ip_logs.order'); }
		if (session()->get('user_ip_logs.page')) { $this->page = session()->get('user_ip_logs.page'); }
		if (session()->get('user_ip_logs.regsSelectedArray')) { $this->regsSelectedArray = session()->get('user_ip_logs.regsSelectedArray'); }
		// general vars
		if (session()->get('user_ip_logs.currentModal')) { $this->currentModal = session()->get('user_ip_logs.currentModal'); }
		//selected regs
		if (session()->get('user_ip_logs.regsSelectedArray')) { $this->regsSelectedArray = session()->get('user_ip_logs.regsSelectedArray'); }
		if (session()->get('user_ip_logs.checkAllSelector')) { $this->checkAllSelector = session()->get('user_ip_logs.checkAllSelector'); }
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
    	$regs = UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
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
    	$this->perPage = '25';
    }

    public function clearAllFilters()
    {
    	$this->search = '';
    	$this->page = 1;
    	$this->perPage = '25';
		$this->order = 'id_desc';
		$this->filterUser = "all";

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
			if ($reg = UserIpLog::find($reg)) {
				if ($reg->canDestroy()) {
					if ($reg->delete()) {
						$regs_deleted++;
					}
				}
			}
		}

		if ($regs_deleted > 0) {
			session()->flash('success', $regs_to_delete === 1 ? 'Registro eliminado correctamente!.' : 'Registros eliminados correctamente!.');
		} else {
			if ($regs_to_delete === 1) {
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
    	$this->regView = UserIpLog::find($id);
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

    	$filename = $this->filenameExportTable ?: 'user_ip_logs';

    	$regs = UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
    		->get();

		session()->flash('success', 'Registros exportados correctamente!.');

    	return Excel::download(new UserIpLogsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'user_ip_logs_seleccionados';

    	$regs = UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
    		->whereIn('user_ip_logs.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
        	->get();
        $regs->makeHidden(['user_name', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');

		return Excel::download(new UserIpLogsExport($regs), $filename . '.' . $this->formatExport);
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

        return view('admin.user_ip_logs', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'users' => $users,
        			'filterUserName' => $this->filterUserName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() === 0)) {
			$this->page = 1;
		}

		if ($this->page === 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
    		->name($this->search)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
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
		return UserIpLog::
    		leftJoin('users', 'users.id', 'user_ip_logs.user_id')
    		->select('user_ip_logs.*', 'users.name as user_name')
			->whereIn('user_ip_logs.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('user_ip_logs.id', 'desc')
			->get();
	}

	protected function filterUserName()
	{
		if ($this->filterUser != "all") {
			if ($var = User::find($this->filterUser)) {
				return $var->name;
			} else {
				$this->filterUser = "all";
			}
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
                'field'     => 'user_ip_logs.ip',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'user_ip_logs.ip',
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
            'location' => [
                'field'     => 'location',
                'direction' => 'asc'
            ],
            'location_desc' => [
                'field'     => 'location',
                'direction' => 'desc'
            ],
            'counter' => [
                'field'     => 'user_ip_logs.counter',
                'direction' => 'asc'
            ],
            'counter_desc' => [
                'field'     => 'user_ip_logs.counter',
                'direction' => 'desc'
            ],
            'date_last_login' => [
                'field'     => 'user_ip_logs.date_last_login',
                'direction' => 'asc'
            ],
            'date_last_login_desc' => [
                'field'     => 'user_ip_logs.date_last_login',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'user_ip_logs.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}
