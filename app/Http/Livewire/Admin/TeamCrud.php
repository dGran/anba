<?php

namespace App\Http\Livewire\Admin;

use App\Models\Team;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\TeamsExport;
use App\Imports\TeamsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Events\TableWasUpdated;

class TeamCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "equipo";
	public $modelPlural = "equipos";
	public $modelGender = "male";
	public $modelHasImg = true;

	//fields
	public $reg_id, $name, $medium_name, $short_name, $division_id, $manager_id, $img, $reg_img, $reg_img_formated, $stadium, $color, $active;
	public $users = [];

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterDivision = "all";
	public $filterActive = "all";
	public $order = 'id_desc';

	// preferences vars
	public $striped;
	public $fixedFirstColumn;
	public $showTableImages;
	public $colMediumName;
	public $colShortName;
	public $colDivision;
	public $colManager;
	public $colStadium;
	public $colColor;

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
		'filterDivision' => ['except' => "all"],
		'filterActive' => ['except' => "all"],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'teams.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'teams.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'teams.striped' => $this->striped ? 'on' : 'off',
			'teams.colMediumName' => $this->colMediumName ? 'on' : 'off',
			'teams.colShortName' => $this->colShortName ? 'on' : 'off',
			'teams.colDivision' => $this->colDivision ? 'on' : 'off',
			'teams.colManager' => $this->colManager ? 'on' : 'off',
			'teams.colStadium' => $this->colStadium ? 'on' : 'off',
			'teams.colColor' => $this->colColor ? 'on' : 'off',
		]);

		if (!$this->colMediumName && !$this->colShortName && !$this->colDivision && !$this->colManager && !$this->colStadium && !$this->colColor) {
			session(['teams.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('teams.showTableImages')) {
			$this->showTableImages = session()->get('teams.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('teams.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('teams.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}
		if (session()->get('teams.striped')) {
			$this->striped = session()->get('teams.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('teams.colMediumName')) {
			$this->colMediumName = session()->get('teams.colMediumName') == 'on' ? true : false;
		} else {
			$this->colMediumName = true;
		}
		if (session()->get('teams.colShortName')) {
			$this->colShortName = session()->get('teams.colShortName') == 'on' ? true : false;
		} else {
			$this->colShortName = true;
		}
		if (session()->get('teams.colDivision')) {
			$this->colDivision = session()->get('teams.colDivision') == 'on' ? true : false;
		} else {
			$this->colDivision = true;
		}
		if (session()->get('teams.colManager')) {
			$this->colManager = session()->get('teams.colManager') == 'on' ? true : false;
		} else {
			$this->colManager = true;
		}
		if (session()->get('teams.colStadium')) {
			$this->colStadium = session()->get('teams.colStadium') == 'on' ? true : false;
		} else {
			$this->colStadium = true;
		}
		if (session()->get('teams.colColor')) {
			$this->colColor = session()->get('teams.colColor') == 'on' ? true : false;
		} else {
			$this->colColor = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'teams.reg_id' => $this->reg_id,
			'teams.name' => $this->name,
			'teams.medium_name' => $this->medium_name,
			'teams.short_name' => $this->short_name,
			'teams.division_id' => $this->division_id,
			'teams.manager_id' => $this->manager_id,
			'teams.reg_img' => $this->reg_img,
			'teams.reg_img_formated' => $this->reg_img_formated,
			'teams.stadium' => $this->stadium,
			'teams.color' => $this->color,
			'teams.active' => $this->active,
			//filters
			'teams.search' => $this->search,
			'teams.perPage' => $this->perPage,
			'teams.filterDivision' => $this->filterDivision,
			'teams.filterActive' => $this->filterActive,
			'teams.order' => $this->order,
			'teams.page' => $this->page,
			'teams.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'teams.currentModal' => $this->currentModal,
			'teams.editMode' => $this->editMode,
			'teams.continuousInsert' => $this->continuousInsert,
			//selected regs
			'teams.regsSelectedArray' => $this->regsSelectedArray,
			'teams.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('teams.reg_id')) { $this->reg_id = session()->get('teams.reg_id'); }
		if (session()->get('teams.name')) { $this->name = session()->get('teams.name'); }
		if (session()->get('teams.medium_name')) { $this->medium_name = session()->get('teams.medium_name'); }
		if (session()->get('teams.short_name')) { $this->short_name = session()->get('teams.short_name'); }
		if (session()->get('teams.division_id')) { $this->division_id = session()->get('teams.division_id'); }
		if (session()->get('teams.manager_id')) { $this->manager_id = session()->get('teams.manager_id'); }
		if (session()->get('teams.reg_img')) { $this->reg_img = session()->get('teams.reg_img'); }
		if (session()->get('teams.reg_img_formated')) { $this->reg_img_formated = session()->get('teams.reg_img_formated'); }
		if (session()->get('teams.stadium')) { $this->stadium = session()->get('teams.stadium'); }
		if (session()->get('teams.color')) { $this->color = session()->get('teams.color'); }
		if (session()->get('teams.active')) { $this->active = session()->get('teams.active'); }
		//filters
		if (session()->get('teams.search')) { $this->search = session()->get('teams.search'); }
		if (session()->get('teams.perPage')) { $this->perPage = session()->get('teams.perPage'); }
		if (session()->get('teams.filterDivision')) { $this->filterDivision = session()->get('teams.filterDivision'); }
		if (session()->get('teams.filterActive')) { $this->filterActive = session()->get('teams.filterActive'); }
		if (session()->get('teams.order')) { $this->order = session()->get('teams.order'); }
		if (session()->get('teams.page')) { $this->page = session()->get('teams.page'); }
		if (session()->get('teams.regsSelectedArray')) { $this->regsSelectedArray = session()->get('teams.regsSelectedArray'); }
		// general vars
		if (session()->get('teams.currentModal')) { $this->currentModal = session()->get('teams.currentModal'); }
		if (session()->get('teams.editMode')) { $this->editMode = session()->get('teams.editMode'); }
		if (session()->get('teams.continuousInsert')) { $this->continuousInsert = session()->get('teams.continuousInsert'); }
		//selected regs
		if (session()->get('teams.regsSelectedArray')) { $this->regsSelectedArray = session()->get('teams.regsSelectedArray'); }
		if (session()->get('teams.checkAllSelector')) { $this->checkAllSelector = session()->get('teams.checkAllSelector'); }
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
    	$regs = Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
    		->name($this->search)
    		->division($this->filterDivision)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
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

    public function cancelFilterDivision()
    {
    	$this->filterDivision = "all";
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
		$this->filterDivision = "all";
		$this->filterActive = "all";

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
		$this->medium_name = null;
		$this->short_name = null;
		$this->img = null;
		$this->reg_img = null;
		$this->reg_img_formated = null;
		$this->division_id = null;
		$this->manager_id = null;
		$this->stadium = null;
		$this->color = "#191919";
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

    	$this->users = User::orderBy('name', 'asc')
    			->whereNotIn('id', function($query) {
					$query->select('manager_id')->from('teams')->whereNotNull('manager_id');
                })->get();

    	$this->editMode = false;
    }

    public function store()
    {
        if ($this->img) {
	       $validatedData = $this->validate([
	       		'name' => 'required|unique:teams,name',
	       		'medium_name' => 'required',
	       		'short_name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
		    	'medium_name.required' => 'El nombre medio es obligatorio',
		    	'short_name.required' => 'El nombre corto es obligatorio',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('teams', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	       		'name' => 'required|unique:teams,name',
	       		'medium_name' => 'required',
	       		'short_name' => 'required',
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
		    	'medium_name.required' => 'El nombre medio es obligatorio',
		    	'short_name.required' => 'El nombre corto es obligatorio',
	        ]);
	    }
	    $validatedData['medium_name'] = $this->medium_name;
	    $validatedData['short_name'] = $this->short_name;
		$validatedData['division_id'] = $this->division_id ?: null;
		$validatedData['manager_id'] = $this->manager_id ?: null;
		$validatedData['stadium'] = $this->stadium;
		$validatedData['color'] = $this->color;
		$validatedData['active'] = $this->active ?: 0;
		if (!$this->active) {
			$validatedData['manager_id'] = null;
		}
        $validatedData['slug'] = Str::slug($this->name, '-');

        $reg = Team::create($validatedData);

        if ($reg->manager_id) {
        	$reg->user->assignRole('manager');
        }

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

    	$reg = Team::find($id);

		$this->reg_id = $reg->id;
    	$this->name = $reg->name;
    	$this->medium_name = $reg->medium_name;
    	$this->short_name = $reg->short_name;
    	$this->reg_img = $reg->img;
		$this->reg_img_formated = $reg->getImg();
    	$this->division_id = $reg->division_id;
		$this->manager_id = $reg->manager_id;
		$this->stadium = $reg->stadium;
		$this->color = $reg->color;
		$this->active = $reg->active;

    	$this->users = User::orderBy('name', 'asc')
    			->whereNotIn('id', function($query) use ($reg) {
					$query->select('manager_id')->from('teams')->where('manager_id', '!=', $reg->manager_id)->whereNotNull('manager_id');
                })->get();

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Team::find($this->reg_id);
    	if ($reg->user) {
    		$old_user = $reg->user;
    	}
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        if ($this->img) {
	        $validatedData = $this->validate([
	       		'name' => 'required|unique:teams,name,' . $reg->id,
	       		'medium_name' => 'required',
	       		'short_name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
		    	'medium_name.required' => 'El nombre medio es obligatorio',
		    	'short_name.required' => 'El nombre corto es obligatorio',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        Storage::disk('public')->delete($reg->img);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('teams', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	       		'name' => 'required|unique:teams,name,' . $reg->id,
	       		'medium_name' => 'required',
	       		'short_name' => 'required',
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
		    	'name.unique' => 'El existe un registro con el mismo nombre',
		    	'medium_name.required' => 'El nombre medio es obligatorio',
		    	'short_name.required' => 'El nombre corto es obligatorio',
	        ]);

	        if (is_null($this->reg_img)) {
				Storage::disk('public')->delete($reg->img);
	        	$validatedData['img'] = null;
	        }
	    }
	    $validatedData['medium_name'] = $this->medium_name;
	    $validatedData['short_name'] = $this->short_name;
		$validatedData['division_id'] = $this->division_id ?: null;
		$validatedData['manager_id'] = $this->manager_id ?: null;
		$validatedData['stadium'] = $this->stadium;
		$validatedData['color'] = $this->color;
		$validatedData['active'] = $this->active ?: 0;
		if (!$this->active) {
			$validatedData['manager_id'] = null;
		}
        $validatedData['slug'] = Str::slug($this->name, '-');

		$reg->fill($validatedData);

        if ($reg->isDirty()) {
            if ($reg->update()) {
		    	if (isset($old_user)) {
					$old_user->removeRole('manager');
		    	}
		    	if ($this->manager_id) {
		    		$user = User::find($this->manager_id);
        			$user->assignRole('manager');
		    	}
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
			if ($reg = Team::find($reg)) {
				$storageImg = $reg->img;
				if ($reg->canDestroy()) {
					if ($reg->user) {
						$reg->user->removeRole('manager');
					}
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
    	$this->regView = Team::find($id);
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
	            if ($original = Team::find($reg)) {
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
            if ($original = Team::find(reset($this->regsSelectedArray))) {
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

    	$filename = $this->filenameExportTable ?: 'equipos';

    	$regs = Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
    		->name($this->search)
    		->division($this->filterDivision)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
    		->get();

		$regs->makeHidden(['slug', 'division_name', 'manager_name', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new TeamsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'equipos_seleccionados';

    	$regs = Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
    		->whereIn('teams.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
        	->get();
        $regs->makeHidden(['slug', 'division_name', 'manager_name', 'created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new TeamsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new TeamsImport, $this->fileImport);
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
    	$reg = Team::find($id);
    	$active ? $reg->user->assignRole('manager') : $reg->user->removeRole('manager');
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

    	$divisions = Division::orderBy('name', 'asc')->get();

        return view('admin.teams', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'divisions' => $divisions,
        			'filterDivisionName' => $this->filterDivisionName(),
        			'filterActiveName' => $this->filterActiveName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
    		->name($this->search)
    		->division($this->filterDivision)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
    		->name($this->search)
    		->division($this->filterDivision)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
    		->name($this->search)
    		->division($this->filterDivision)
			->active($this->filterActive)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
			->paginate($this->perPage, ['*'], 'page', $this->page);

		$this->checkAllSelector = 1;
		foreach ($regs as $player) {
			$array_id = array_search($player->id, $this->regsSelectedArray);
			if (!$array_id) {
				$this->checkAllSelector = 0;
			}
		}
	}

	protected function getDataSelected()
	{
		return Team::
    		leftJoin('divisions', 'divisions.id', 'teams.division_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->select('teams.*', 'divisions.name as division_name', 'users.name as manager_name')
			->whereIn('teams.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('teams.name', 'asc')
			->get();
	}

	protected function filterDivisionName()
	{
		if ($this->filterDivision != "all") {
			if ($var = Division::find($this->filterDivision)) {
				return $var->name;
			} else {
				$this->filterDivision = "all";
			}
		}
	}
	protected function filterActiveName()
	{
		if ($this->filterActive != "all") {
			return $this->filterActive == "active" ? 'Activos' : 'Inactivos';
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
                'field'     => 'teams.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'teams.name',
                'direction' => 'desc'
            ],
            'medium_name' => [
                'field'     => 'teams.medium_name',
                'direction' => 'asc'
            ],
            'medium_name_desc' => [
                'field'     => 'teams.medium_name',
                'direction' => 'desc'
            ],
            'short_name' => [
                'field'     => 'teams.short_name',
                'direction' => 'asc'
            ],
            'short_name_desc' => [
                'field'     => 'teams.short_name',
                'direction' => 'desc'
            ],
            'division' => [
                'field'     => 'divisions.name',
                'direction' => 'asc'
            ],
            'division_desc' => [
                'field'     => 'divisions.name',
                'direction' => 'desc'
            ],
            'manager' => [
                'field'     => 'users.name',
                'direction' => 'asc'
            ],
            'manager_desc' => [
                'field'     => 'users.name',
                'direction' => 'desc'
            ],
            'stadium' => [
                'field'     => 'teams.stadium',
                'direction' => 'asc'
            ],
            'stadium_desc' => [
                'field'     => 'teams.stadium',
                'direction' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'teams.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}