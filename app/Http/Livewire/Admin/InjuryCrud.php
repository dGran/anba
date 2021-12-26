<?php

namespace App\Http\Livewire\Admin;

use App\Models\Injury;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\InjuriesExport;
use App\Imports\InjuriesImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Events\TableWasUpdated;

class InjuryCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "lesión";
	public $modelPlural = "lesiones";
	public $modelGender = "female";
	public $modelHasImg = false;

	//fields
	public $reg_id, $name;

	//filters
	public $search = "";
	public $perPage = '25';
	public $order = 'id_desc';

	// preferences vars
	public $striped;

	// general vars
	public $currentModal;
	public $editMode = false;
	public $continuousInsert = false;
	public $regView;

	//selected regs
	public $regsSelectedArray = [];
	public $checkAllSelector = 0;

	//import & export
	public $fileImport;
	public $formatExport = '';
	public $filenameExportTable = '';
	public $filenameExportSelected = '';

	// queryString
	protected $queryString = [
		'search' => ['except' => ''],
		'perPage' => ['except' => '25'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'injuries.striped' => $this->striped ? 'on' : 'off',
		]);
	}

	protected function getSessionPreferences()
	{
		if (session()->get('injuries.striped')) {
			$this->striped = session()->get('injuries.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'injuries.reg_id' => $this->reg_id,
			'injuries.name' => $this->name,
			//filters
			'injuries.search' => $this->search,
			'injuries.perPage' => $this->perPage,
			'injuries.order' => $this->order,
			'injuries.page' => $this->page,
			'injuries.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'injuries.currentModal' => $this->currentModal,
			'injuries.editMode' => $this->editMode,
			'injuries.continuousInsert' => $this->continuousInsert,
			//selected regs
			'injuries.regsSelectedArray' => $this->regsSelectedArray,
			'injuries.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('injuries.reg_id')) { $this->reg_id = session()->get('injuries.reg_id'); }
		if (session()->get('injuries.name')) { $this->name = session()->get('injuries.name'); }
		//filters
		if (session()->get('injuries.search')) { $this->search = session()->get('injuries.search'); }
		if (session()->get('injuries.perPage')) { $this->perPage = session()->get('injuries.perPage'); }
		if (session()->get('injuries.order')) { $this->order = session()->get('injuries.order'); }
		if (session()->get('injuries.page')) { $this->page = session()->get('injuries.page'); }
		if (session()->get('injuries.regsSelectedArray')) { $this->regsSelectedArray = session()->get('injuries.regsSelectedArray'); }
		// general vars
		if (session()->get('injuries.currentModal')) { $this->currentModal = session()->get('injuries.currentModal'); }
		if (session()->get('injuries.editMode')) { $this->editMode = session()->get('injuries.editMode'); }
		if (session()->get('injuries.continuousInsert')) { $this->continuousInsert = session()->get('injuries.continuousInsert'); }
		//selected regs
		if (session()->get('injuries.regsSelectedArray')) { $this->regsSelectedArray = session()->get('injuries.regsSelectedArray'); }
		if (session()->get('injuries.checkAllSelector')) { $this->checkAllSelector = session()->get('injuries.checkAllSelector'); }
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
    	$regs = Injury::
    		select('injuries.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
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

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
    }

    public function add()
    {
    	$this->resetFields();
		$this->resetValidation();
    	$this->emit('openAddModal');
    	$this->setCurrentModal('addModal');

    	$this->editMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:injuries,name',
        ],
	    [
	    	'name.required' => 'El nombre es obligatorio',
	    	'name.unique' => 'El existe un registro con el mismo nombre',
        ]);

        $reg = Injury::create($validatedData);

        event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT)));
        session()->flash('success', 'Registro agregado correctamente.');

		if ($this->continuousInsert) {
			$this->resetFields();
		} else {
			$this->resetFields();
			$this->emit('closeAddModal');
			$this->closeAnyModal();
		}
    }

	// Edit & Update
    public function edit($id)
    {
    	$this->resetFields();
		$this->resetValidation();

    	$reg = Injury::find($id);
		$this->reg_id = $reg->id;
    	$this->name = $reg->name;

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Injury::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        $validatedData = $this->validate([
            'name' => 'required|unique:injuries,name,' . $reg->id,
        ],
	    [
	    	'name.required' => 'El nombre es obligatorio',
	    	'name.unique' => 'El existe un registro con el mismo nombre',
        ]);

		$reg->fill($validatedData);

        if ($reg->isDirty()) {
            if ($reg->update()) {
            	event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));
            	session()->flash('success', 'Registro actualizado correctamente.');
            } else {
            	session()->flash('error', 'Se ha producido un error y no se han podido actualizar los datos.');
            }
        } else {
        	session()->flash('info', 'No se han detectado cambios en el registro.');
        }

        $this->emit('closeEditModal');
        $this->closeAnyModal();

        $this->cancelSelection();
		$this->resetFields();
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
			if ($reg = Injury::find($reg)) {
				if ($reg->canDestroy()) {
					event(new TableWasUpdated($reg, 'delete'));
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
    	$this->regView = Injury::find($id);
    	$this->emit('openViewModal');
    }

    // Duplicate
    public function confirmDuplicate()
    {
		$this->emit('openDuplicateModal');
    }

    public function duplicate()
    {
    	if (count($this->regsSelectedArray) > 1) {
    		$counter = 0;
			foreach ($this->regsSelectedArray as $reg) {
	            if ($original = Injury::find($reg)) {
	            	$counter++;
	                $reg = $original->replicate();
	            	$random_number = rand(100,999);
	            	$random_text = "_copia_" . $random_number;
	            	$reg->name .= $random_text;
	                $reg->save();
	            	event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro duplicado'));
	            }
			}
			if ($counter > 0) {
				session()->flash('success', 'Registros seleccionados duplicados correctamente!.');
			} else {
				session()->flash('error', 'Los registros que querías duplicar ya no existen.');
			}
		} elseif (count($this->regsSelectedArray) == 1) {
            if ($original = Injury::find(reset($this->regsSelectedArray))) {
                $reg = $original->replicate();
            	$random_number = rand(100,999);
            	$random_text = "_copia_" . $random_number;
            	$reg->name .= $random_text;
                $reg->save();
            	event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro duplicado'));
                session()->flash('success', 'Registro duplicado correctamente!.');
            } else {
            	session()->flash('error', 'El registro que querías duplicar ya no existe.');
            }
		}

		$this->emit('closeDuplicateModal');
		$this->regsSelectedArray = [];
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

    	$filename = $this->filenameExportTable ?: 'lesiones';

    	$regs = Injury::
    		select('injuries.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
    		->get();

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new InjuriesExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'lesiones_seleccionadas';

    	$regs = Injury::
    		select('injuries.*')
    		->whereIn('injuries.id', $this->regsSelectedArray)
        	->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
        	->get();

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new InjuriesExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new InjuriesImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		session()->flash('success', 'Registros importados correctamente!.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
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


        return view('admin.injuries', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Injury::
    		select('injuries.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Injury::
    		select('injuries.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Injury::
    		select('injuries.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
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
		return Injury::
    		select('injuries.*')
			->whereIn('injuries.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('injuries.name', 'asc')
			->get();
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
                'field'     => 'injuries.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'injuries.name',
                'direction' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'injuries.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}
