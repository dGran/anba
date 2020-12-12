<?php

namespace App\Http\Livewire\Admin;

use App\Models\Conference;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\ConferencesExport;
use App\Imports\ConferencesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Events\TableWasUpdated;

class ConferenceCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "conferencia";
	public $modelPlural = "conferencias";
	public $modelGender = "female";
	public $modelHasImg = true;

	//fields
	public $reg_id, $name, $img, $reg_img, $reg_img_formated, $active;

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterActive = "all";
	public $order = 'id_desc';

	// preferences vars
	public $striped;
	public $showTableImages;

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
		'filterActive' => ['except' => "all"],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'conferences.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'conferences.striped' => $this->striped ? 'on' : 'off',
		]);
	}

	protected function getSessionPreferences()
	{
		if (session()->get('conferences.showTableImages')) {
			$this->showTableImages = session()->get('conferences.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('conferences.striped')) {
			$this->striped = session()->get('conferences.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'conferences.reg_id' => $this->reg_id,
			'conferences.name' => $this->name,
			'conferences.reg_img' => $this->reg_img,
			'conferences.reg_img_formated' => $this->reg_img_formated,
			'conferences.active' => $this->active,
			//filters
			'conferences.search' => $this->search,
			'conferences.perPage' => $this->perPage,
			'conferences.filterActive' => $this->filterActive,
			'conferences.order' => $this->order,
			'conferences.page' => $this->page,
			'conferences.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'conferences.currentModal' => $this->currentModal,
			'conferences.editMode' => $this->editMode,
			'conferences.continuousInsert' => $this->continuousInsert,
			//selected regs
			'conferences.regsSelectedArray' => $this->regsSelectedArray,
			'conferences.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('conferences.reg_id')) { $this->reg_id = session()->get('conferences.reg_id'); }
		if (session()->get('conferences.name')) { $this->name = session()->get('conferences.name'); }
		if (session()->get('conferences.reg_img')) { $this->reg_img = session()->get('conferences.reg_img'); }
		if (session()->get('conferences.reg_img_formated')) { $this->reg_img_formated = session()->get('conferences.reg_img_formated'); }
		if (session()->get('conferences.active')) { $this->active = session()->get('conferences.active'); }
		//filters
		if (session()->get('conferences.search')) { $this->search = session()->get('conferences.search'); }
		if (session()->get('conferences.perPage')) { $this->perPage = session()->get('conferences.perPage'); }
		if (session()->get('conferences.filterActive')) { $this->filterActive = session()->get('conferences.filterActive'); }
		if (session()->get('conferences.order')) { $this->order = session()->get('conferences.order'); }
		if (session()->get('conferences.page')) { $this->page = session()->get('conferences.page'); }
		if (session()->get('conferences.regsSelectedArray')) { $this->regsSelectedArray = session()->get('conferences.regsSelectedArray'); }
		// general vars
		if (session()->get('conferences.currentModal')) { $this->currentModal = session()->get('conferences.currentModal'); }
		if (session()->get('conferences.editMode')) { $this->editMode = session()->get('conferences.editMode'); }
		if (session()->get('conferences.continuousInsert')) { $this->continuousInsert = session()->get('conferences.continuousInsert'); }
		//selected regs
		if (session()->get('conferences.regsSelectedArray')) { $this->regsSelectedArray = session()->get('conferences.regsSelectedArray'); }
		if (session()->get('conferences.checkAllSelector')) { $this->checkAllSelector = session()->get('conferences.checkAllSelector'); }
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
    	$regs = Conference::
    		select('conferences.*')
    		->name($this->search)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
    		->paginate($this->perPage, ['*'], 'page', $this->page);
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
		$this->filterActive = "all";

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
		$this->img = null;
		$this->reg_img = null;
		$this->reg_img_formated = null;
		$this->active = 1;
    }

    public function resetImg()
    {
    	$this->img = null;
    	$this->reg_img = null;
    	$this->reg_img_formated = null;
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
        if ($this->img) {
	       $validatedData = $this->validate([
	       		'name' => 'required|unique:conferences,name',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('conferences', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	            'name' => 'required|unique:conferences,name',
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
	        ]);
	    }
		$validatedData['active'] = $this->active ?: 0;
        $validatedData['slug'] = Str::slug($this->name, '-');

        $reg = Conference::create($validatedData);

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

    	$reg = Conference::find($id);
		$this->reg_id = $reg->id;
    	$this->name = $reg->name;
    	$this->reg_img = $reg->img;
		$this->reg_img_formated = $reg->getImg();
		$this->active = $reg->active;

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Conference::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        if ($this->img) {
	        $validatedData = $this->validate([
	       		'name' => 'required|unique:conferences,name,' . $reg->id,
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        Storage::disk('public')->delete($reg->img);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('conferences', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	            'name' => 'required|unique:conferences,name,' . $reg->id,
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
	        ]);

	        if (is_null($this->reg_img)) {
				Storage::disk('public')->delete($reg->img);
	        	$validatedData['img'] = null;
	        }
	    }
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
			if ($reg = Conference::find($reg)) {
				$storageImg = $reg->img;
				if ($reg->canDestroy()) {
					event(new TableWasUpdated($reg, 'delete'));
					if ($reg->delete()) {
						$regs_deleted++;
	                	// remove image from Storage
						Storage::disk('public')->delete($storageImg);
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
    	$this->regView = Conference::find($id);
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
	            if ($original = Conference::find($reg)) {
	            	$counter++;
	                $reg = $original->replicate();
	            	$random_number = rand(100,999);
	            	$random_text = "_copia_" . $random_number;
	            	$reg->name .= $random_text;
	            	if ($reg->storageImg()) {
	            		$pos = strpos($reg->img, '.');
	            		$original_img_name = substr($reg->img, 0, $pos);
	            		$original_img_ext = substr($reg->img, $pos, strlen($reg->img) - $pos);
	            		$img_name = $original_img_name . $random_text . $original_img_ext;
						Storage::disk('public')->copy($reg->img, $img_name);
						$reg->img = $img_name;
	            	}
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
            if ($original = Conference::find(reset($this->regsSelectedArray))) {
                $reg = $original->replicate();
            	$random_number = rand(100,999);
            	$random_text = "_copia_" . $random_number;
            	$reg->name .= $random_text;
            	if ($reg->storageImg()) {
            		$pos = strpos($reg->img, '.');
            		$original_img_name = substr($reg->img, 0, $pos);
            		$original_img_ext = substr($reg->img, $pos, strlen($reg->img) - $pos);
            		$img_name = $original_img_name . $random_text . $original_img_ext;
					Storage::disk('public')->copy($reg->img, $img_name);
					$reg->img = $img_name;
            	}
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

    	$filename = $this->filenameExportTable ?: 'conferencias';

    	$regs = Conference::
    		select('conferences.*')
    		->name($this->search)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
    		->get();

		$regs->makeHidden(['slug', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new ConferencesExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'conferencias_seleccionadas';

    	$regs = Conference::
    		select('conferences.*')
    		->whereIn('conferences.id', $this->regsSelectedArray)
        	->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
        	->get();
        $regs->makeHidden(['slug', 'created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new ConferencesExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new ConferencesImport, $this->fileImport);
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
    	$reg = Conference::find($id);
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

        return view('admin.conferences', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'filterActiveName' => $this->filterActiveName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Conference::
    		select('conferences.*')
    		->name($this->search)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Conference::
    		select('conferences.*')
    		->name($this->search)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Conference::
    		select('conferences.*')
    		->name($this->search)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
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
		return Conference::
    		select('conferences.*')
			->whereIn('conferences.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->get();
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
                'field'     => 'conferences.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
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
			'conferences.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}