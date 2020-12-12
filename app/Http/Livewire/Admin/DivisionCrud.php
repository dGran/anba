<?php

namespace App\Http\Livewire\Admin;

use App\Models\Division;
use App\Models\Conference;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\DivisionsExport;
use App\Imports\DivisionsImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Events\TableWasUpdated;

class DivisionCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "división";
	public $modelPlural = "divisiones";
	public $modelGender = "female";
	public $modelHasImg = false;

	//fields
	public $reg_id, $name, $conference_id, $active;

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterConference = "all";
	public $filterActive = "all";
	public $order = 'id_desc';

	// preferences vars
	public $showTableImages;
	public $striped;
	public $fixedFirstColumn;
	public $colConference;

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
		'filterConference' => ['except' => "all"],
		'filterActive' => ['except' => "all"],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'divisions.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'divisions.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'divisions.striped' => $this->striped ? 'on' : 'off',
			'divisions.colConference' => $this->colConference ? 'on' : 'off',
		]);

		if (!$this->colConference) {
			session(['divisions.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('divisions.showTableImages')) {
			$this->showTableImages = session()->get('divisions.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('divisions.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('divisions.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}
		if (session()->get('divisions.striped')) {
			$this->striped = session()->get('divisions.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('divisions.colConference')) {
			$this->colConference = session()->get('divisions.colConference') == 'on' ? true : false;
		} else {
			$this->colConference = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'divisions.reg_id' => $this->reg_id,
			'divisions.name' => $this->name,
			'divisions.conference_id' => $this->conference_id,
			'divisions.active' => $this->active,
			//filters
			'divisions.search' => $this->search,
			'divisions.perPage' => $this->perPage,
			'divisions.filterConference' => $this->filterConference,
			'divisions.filterActive' => $this->filterActive,
			'divisions.order' => $this->order,
			'divisions.page' => $this->page,
			'divisions.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'divisions.currentModal' => $this->currentModal,
			'divisions.editMode' => $this->editMode,
			'divisions.continuousInsert' => $this->continuousInsert,
			//selected regs
			'divisions.regsSelectedArray' => $this->regsSelectedArray,
			'divisions.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('divisions.reg_id')) { $this->reg_id = session()->get('divisions.reg_id'); }
		if (session()->get('divisions.name')) { $this->name = session()->get('divisions.name'); }
		if (session()->get('divisions.conference_id')) { $this->conference_id = session()->get('divisions.conference_id'); }
		if (session()->get('divisions.active')) { $this->active = session()->get('divisions.active'); }
		//filters
		if (session()->get('divisions.search')) { $this->search = session()->get('divisions.search'); }
		if (session()->get('divisions.perPage')) { $this->perPage = session()->get('divisions.perPage'); }
		if (session()->get('divisions.filterConference')) { $this->filterConference = session()->get('divisions.filterConference'); }
		if (session()->get('divisions.filterActive')) { $this->filterActive = session()->get('divisions.filterActive'); }
		if (session()->get('divisions.order')) { $this->order = session()->get('divisions.order'); }
		if (session()->get('divisions.page')) { $this->page = session()->get('divisions.page'); }
		if (session()->get('divisions.regsSelectedArray')) { $this->regsSelectedArray = session()->get('divisions.regsSelectedArray'); }
		// general vars
		if (session()->get('divisions.currentModal')) { $this->currentModal = session()->get('divisions.currentModal'); }
		if (session()->get('divisions.editMode')) { $this->editMode = session()->get('divisions.editMode'); }
		if (session()->get('divisions.continuousInsert')) { $this->continuousInsert = session()->get('divisions.continuousInsert'); }
		//selected regs
		if (session()->get('divisions.regsSelectedArray')) { $this->regsSelectedArray = session()->get('divisions.regsSelectedArray'); }
		if (session()->get('divisions.checkAllSelector')) { $this->checkAllSelector = session()->get('divisions.checkAllSelector'); }
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
    	$regs = Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
    		->name($this->search)
    		->conference($this->filterConference)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
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

    public function cancelFilterConference()
    {
		$this->filterConference = "all";
    }

    public function cancelFilterActive()
    {
		$this->filterActive = "all";
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
		$this->filterConference = "all";
		$this->filterActive = "all";

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
		$this->img = null;
		$this->conference_id = null;
		$this->active = 1;
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
            'name' => 'required|unique:divisions,name',
        ],
	    [
	    	'name.required' => 'El nombre es obligatorio',
	    	'name.unique' => 'El existe un registro con el mismo nombre',
        ]);

		$validatedData['conference_id'] = $this->conference_id ?: null;
		$validatedData['active'] = $this->active ?: 0;
        $validatedData['slug'] = Str::slug($this->name, '-');

        $reg = Division::create($validatedData);

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

    	$reg = Division::find($id);
		$this->reg_id = $reg->id;
    	$this->name = $reg->name;
    	$this->conference_id = $reg->conference_id;
		$this->active = $reg->active;

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Division::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        $validatedData = $this->validate([
            'name' => 'required|unique:divisions,name,' . $reg->id,
        ],
	    [
	    	'name.required' => 'El nombre es obligatorio',
	    	'name.unique' => 'El existe un registro con el mismo nombre',
        ]);

		$validatedData['conference_id'] = $this->conference_id ?: null;
		$validatedData['active'] = $this->active ?: 0;
        $validatedData['slug'] = Str::slug($this->name, '-');

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
			if ($reg = Division::find($reg)) {
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
    	$this->regView = Division::find($id);
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
	            if ($original = Division::find($reg)) {
	            	$counter++;
	                $reg = $original->replicate();
	            	$random_number = rand(100,999);
	            	$random_text = "_copia_" . $random_number;
	            	$reg->name .= $random_text;
	            	$reg->slug = Str::slug($reg->name, '-');
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
            if ($original = Division::find(reset($this->regsSelectedArray))) {
                $reg = $original->replicate();
            	$random_number = rand(100,999);
            	$random_text = "_copia_" . $random_number;
            	$reg->name .= $random_text;
            	$reg->slug = Str::slug($reg->name, '-');
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

    	$filename = $this->filenameExportTable ?: 'divisiones';

    	$regs = Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
    		->name($this->search)
    		->conference($this->filterConference)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
    		->get();

		$regs->makeHidden(['slug', 'conference_name', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new DivisionsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'divisiones_seleccionadas';

    	$regs = Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
    		->whereIn('divisions.id', $this->regsSelectedArray)
        	->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
        	->get();
        $regs->makeHidden(['slug', 'conference_name', 'created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new DivisionsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new DivisionsImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		session()->flash('success', 'Registros importados correctamente!.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
    }

	// Update fields
    public function active($id, $active)
    {
    	$reg = Division::find($id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);
    	$reg->active = $active;
    	$reg->save();
    	event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));

    	session()->flash('success', 'Registro actualizado correctamente.');
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

    	$conferences = Conference::orderBy('name', 'asc')->get();

        return view('admin.divisions', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'conferences' => $conferences,
        			'filterConferenceName' => $this->filterConferenceName(),
        			'filterActiveName' => $this->filterActiveName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
    		->name($this->search)
    		->conference($this->filterConference)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
    		->name($this->search)
    		->conference($this->filterConference)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
    		->name($this->search)
    		->conference($this->filterConference)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
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
		return Division::
    		leftJoin('conferences', 'conferences.id', 'divisions.conference_id')
    		->select('divisions.*', 'conferences.name as conference_name')
			->whereIn('divisions.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('divisions.name', 'asc')
			->get();
	}

	protected function filterConferenceName()
	{
		if ($this->filterConference != "all") {
			return Conference::find($this->filterConference)->name;
		}
	}
	protected function filterActiveName()
	{
		if ($this->filterActive != "all") {
			return $this->filterActive == "active" ? 'Activas' : 'Inactivas';
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
                'field'     => 'divisions.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'divisions.name',
                'direction' => 'desc'
            ],
            'conference' => [
                'field'     => 'conferences.name',
                'direction' => 'asc'
            ],
            'conference_desc' => [
                'field'     => 'conferences.name',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'divisions.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}