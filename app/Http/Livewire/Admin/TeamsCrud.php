<?php

namespace App\Http\Livewire\Admin;

use App\Models\Team;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\TeamsExport;
use App\Imports\TeamsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class TeamsCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	//model info
	public $modelSingular = "equipo";
	public $modelPlural = "equipos";
	public $modelGender = "male";
	public $modelHasImg = true;

	//filters
	public $search = "";
	public $perPage = '10';
	public $order = 'id';
	public $orderDirection = 'desc';

	// general vars
	public $editMode = false;

	//selected regs
	public $regsSelectedArray = [];
	public $checkAllSelector = 0;

	//fields
	public $reg_id, $name, $img, $reg_img, $reg_img_formated, $stadium;

	//continuous insertion
	public $continuousInsert = false;

	//import & export
	public $fileImport;
	public $formatExport = '';
	public $filenameExportTable = '';
	public $filenameExportSelected = '';

	//queryString
	protected $queryString = [
		'search' => ['except' => ''],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id']
	];

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
		$teams = Team::name($this->search)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage, ['*'], 'page', $this->page);
		foreach ($teams as $team) {
			if ($this->checkAllSelector == 1) {
				$this->regsSelectedArray[$team->id] = $team->id;
			} else {
				$array_id = array_search($team->id, $this->regsSelectedArray);
				unset($this->regsSelectedArray[$array_id]);
			}
		}
	}

	public function deselect($id)
	{
		$array_id = array_search($id, $this->regsSelectedArray);
		unset($this->regsSelectedArray[$array_id]);
		if (empty($this->regsSelectedArray)) {
			$this->emit('closeSelected');
		}
	}

	public function cancelSelection()
	{
		$this->regsSelectedArray = [];
	}

	public function viewSelected($view)
	{
		if (count($this->regsSelectedArray) > 0) {
			if ($view) {
				$this->emit('openSelected');
			} else {
				$this->emit('closeSelected');
			}
		}
	}
	// END::Selected

	// Filters
	public function viewFilters($view)
	{
		if ($view) {
			$this->emit('openFilters');
		} else {
			$this->emit('closeFilters');
		}
	}

    public function order($field, $direction)
    {
    	$this->order = $field;
    	$this->orderDirection = $direction;
    	$this->page = 1;
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
    	$this->perPage = '10';
    }

    public function clearAllFilters()
    {
    	$this->search = '';
    	$this->page = 1;
    	$this->perPage = '10';
		$this->order = 'id';
		$this->orderDirection = 'desc';
    }

    // Add & Store
    public function resetFields()
    {
		$this->name = null;
		$this->img = null;
		$this->reg_img = null;
		$this->reg_img_formated = null;
		$this->stadium = null;
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
    	$this->emit('addMode');

    	$this->editMode = false;
    }

    public function store()
    {
        if ($this->img) {
	       $validatedData = $this->validate([
	       		'name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
	            'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes',
	            'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('teams', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	            'name' => 'required'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio'
	        ]);
	    }
	    $validatedData['stadium'] = $this->stadium;
        $validatedData['slug'] = Str::slug($this->name, '-');
        Team::create($validatedData);

        session()->flash('success', 'Registro agregado correctamente.');

		if ($this->continuousInsert) {
			$this->resetFields();
		} else {
			$this->resetFields();
			$this->emit('regStore');
		}
    }
    // END::Add & Store

	// Edit & Update
    public function edit($id)
    {
    	$this->resetFields();

    	$team = Team::find($id);
		$this->reg_id = $team->id;
    	$this->name = $team->name;
    	$this->reg_img = $team->img;
		$this->reg_img_formated = $team->getImg();
    	$this->stadium = $team->stadium;

		$this->resetValidation();

    	$this->emit('editMode');
    	$this->editMode = true;
    }

    public function update()
    {
    	$team = Team::find($this->reg_id);

        if ($this->img) {
	        $validatedData = $this->validate([
	       		'name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
	            'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes',
	            'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        Storage::disk('public')->delete($team->img);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('teams', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	            'name' => 'required'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio'
	        ]);

	        if (is_null($this->reg_img)) {
				Storage::disk('public')->delete($team->img);
	        	$validatedData['img'] = null;
	        }
	    }
	    $validatedData['stadium'] = $this->stadium;
	    $validatedData['slug'] = Str::slug($this->name, '-');
		$team->fill($validatedData);

        if ($team->isDirty()) {
            if ($team->update()) {
            	session()->flash('success', 'Registro actualizado correctamente.');
            } else {
            	session()->flash('error', 'Se ha producido un error y no se han podido actualizar los datos.');
            }
        } else {
        	session()->flash('info', 'No se han detectado cambios en el registro.');
        }

        $this->emit('regUpdate');
        $this->cancelSelection();
		$this->resetFields();
    }
    // END::Edit & Update

    public function confirmDestroy()
    {
		$this->emit('destroyMode');
    }

    public function confirmDuplicate()
    {
		$this->emit('duplicateMode');
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('importMode');
    }

    public function confirmExportTable($format)
    {
    	$this->formatExport = $format;
		$this->emit('exportTableMode');
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('exportSelectedMode');
    }

    public function setNextPage()
    {
    	$this->page++;
    }

    public function setPreviousPage()
    {
		$this->page--;
    }

    public function destroy()
    {
    	$regs_to_delete = count($this->regsSelectedArray);
		$regs_deleted = 0;
		foreach ($this->regsSelectedArray as $reg) {
			if ($reg = Team::find($reg)) {
				$storageImg = $reg->img;
				if ($reg->canDestroy()) {
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
			session()->flash('error', $regs_to_delete == 1 ? 'El registro no puede ser eliminado o ya no existe.' : 'No se ha eliminado ningún registro, no pueden ser eliminados o ya no existen.');
		}
		$this->regsSelectedArray = [];
		$this->emit('regDestroy');
    }

    public function duplicate()
    {
    	if (count($this->regsSelectedArray) > 1) {
    		$counter = 0;
			foreach ($this->regsSelectedArray as $reg) {
	            $original = Team::find($reg);
	            if ($original) {
	            	$counter++;
	                $team = $original->replicate();
                	$random_numer = rand(100,999);
                	$team->name .= " (copia_" . $random_numer . ")";
	                $team->save();
	            }
			}
			if ($counter > 0) {
				session()->flash('success', 'Registros seleccionados duplicados correctamente!.');
			} else {
				session()->flash('error', 'Los registros que querías duplicar ya no existen.');
			}
			$this->emit('regDuplicate');
			$this->regsSelectedArray = [];
		} else {
            $original = Team::find(reset($this->regsSelectedArray));
            if ($original) {
                $team = $original->replicate();
            	$random_numer = rand(100,999);
            	$team->name .= " (copia_" . $random_numer . ")";
                $team->save();
                session()->flash('success', 'Registro duplicado correctamente!.');
            } else {
            	session()->flash('error', 'El registro que querías duplicar ya no existe.');
            }
			$this->emit('regDuplicate');
			$this->regsSelectedArray = [];
		}
    }

    public function tableExport()
    {
    	$this->emit('regExportTable');
    	$filename = $this->filenameExportTable ?: 'equipos';

		$teams = Team::name($this->search)
	        		->orderBy($this->order, $this->orderDirection)
	        		->get();
		$teams->makeHidden(['img', 'slug']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new TeamsExport($teams), $filename . '.' . $this->formatExport);
    }

    public function selectedExport()
    {
    	$this->emit('regExportSelected');
    	$filename = $this->filenameExportSelected ?: 'equipos_seleccionados';

        $teams = Team::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
        $teams->makeHidden(['img', 'slug']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new TeamsExport($teams), $filename . '.' . $this->formatExport);
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
    	$this->emit('regImport');
    }

    public function render()
    {
    	// $teams = Team::factory()->count(20)->create();
        return view('livewire.admin.teams', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected()
        		])->layout('adminlte::page');
    }

	private function getData()
	{
		$teams = Team::name($this->search)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage)->onEachSide(2);
	    if (($teams->total() > 0 && $teams->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $teams->lastPage();
		}
    	$teams = Team::name($this->search)
        			->orderBy($this->order, $this->orderDirection)
        			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $teams;
	}

	public function setCheckAllSelector()
	{
		$teams = Team::name($this->search)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage, ['*'], 'page', $this->page);

		$this->checkAllSelector = 1;
		foreach ($teams as $team) {
			$array_id = array_search($team->id, $this->regsSelectedArray);
			if (!$array_id) {
				$this->checkAllSelector = 0;
			}
		}
	}

	private function getDataSelected()
	{
		return Team::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
	}

}