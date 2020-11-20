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


	//selected regs
	public $regsSelectedArray = [];
	public $checkAllSelector = 0;

	//fields
	public $team_id, $name, $img, $stadium;

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
    public function reset_fields()
    {
		$this->name = null;
		$this->img = null;
		$this->stadium = null;
    }

    public function add()
    {
    	$this->reset_fields();
		$this->resetValidation();
    	$this->emit('addMode');
    }

    public function store()
    {
        if ($this->img) {
	       $validatedData = $this->validate([
	       		'name' => 'required',
	            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
	            'img.image' => 'El logo debe ser una imagen',
	            'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
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
        $validatedData['slug'] = Str::slug($this->name, '-');
        Team::create($validatedData);

        $this->emit('alert', ['type' => 'success', 'message' => 'Registro agregado correctamente.']);



		// $this->validate([
		// 	'name' => 'required',
		// ],
  //       [
  //           'name.required' => 'El nombre es obligatorio'
  //       ]);

	 //    $img = null;
		// if ($this->img) {
  //           $this->validate([
  //               'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
  //           ],
  //           [
  //               'img.image' => 'El logo debe ser una imagen',
  //               'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
  //               'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
  //           ]);

	 //        $fileName = time() . '.' . $this->img->extension();
	 //        $img = $this->img->storeAs('teams', $fileName, 'public');
  //       }

		// $team = Team::create([
		// 	'name' => $this->name,
		// 	'img' => $img,
		// 	'stadium' => $this->stadium,
		// 	'slug' => Str::slug($this->name, '-')
		// ]);

		// if ($team->save()) {
		// 	$this->emit('alert', ['type' => 'success', 'message' => 'Registro agregado correctamente.']);
		// } else {
		// 	$this->emit('alert', ['type' => 'error', 'message' => 'Se ha producido un error y no se han podido actualizar los datos.']);
		// }

		if ($this->continuousInsert) {
			$this->reset_fields();
		} else {
			$this->emit('regStore');
		}
    }
    // END::Add & Store

	// Edit & Update
    public function edit($id)
    {
    	$team = Team::find($id);
		$this->team_id = $team->id;
    	$this->name = $team->name;
    	$this->img = $team->img;
    	$this->stadium = $team->stadium;

		$this->resetValidation();

    	$this->emit('editMode');
    }

    public function update()
    {
		$this->validate([
			'name' => 'required',
		]);

    	$team = Team::find($this->team_id);

		$team->name = $this->name;
		$team->img = $this->img;
		$team->stadium = $this->stadium;
		$team->slug = Str::slug($this->name, '-');

        if ($team->isDirty()) {
            if ($team->update()) {
            	$this->emit('alert', ['type' => 'success', 'message' => 'Registro actualizado correctamente.']);
            } else {
            	$this->emit('alert', ['type' => 'error', 'message' => 'Se ha producido un error y no se han podido actualizar los datos.']);
            }
        } else {
        	$this->emit('alert', ['type' => 'info', 'message' => 'No se han detectado cambios en el registro.']);
        }

        $this->cancelSelection();
        $this->emit('regUpdate');
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
			$this->emit('alert', [
				'type' => 'success',
				'message' => $regs_to_delete == 1 ? 'Registro eliminado correctamente!.' : 'Registros eliminados correctamente!.'
			]);
		} else {
			$this->emit('alert', [
				'type' => 'error',
				'message' => $regs_to_delete == 1 ? 'El registro no puede ser eliminado o ya no existe.' : 'No se ha eliminado ningún registro, no pueden ser eliminados o ya no existen.'
			]);
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
				$this->emit('alert', ['type' => 'success', 'message' => 'Registros seleccionados duplicados correctamente!.']);
			} else {
				$this->emit('alert', ['type' => 'error', 'message' => 'Los registros que querías duplicar ya no existen.']);
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
				$this->emit('alert', ['type' => 'success', 'message' => 'Registro duplicado correctamente!.']);
            } else {
            	$this->emit('alert', ['type' => 'error', 'message' => 'El registro que querías duplicar ya no existe.']);
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
		$teams->makeHidden(['slug']);

		$this->emit('alert', ['type' => 'success', 'message' => 'Registros exportados correctamente!.']);
    	return Excel::download(new TeamsExport($teams), $filename . '.' . $this->formatExport);
    }

    public function selectedExport()
    {
    	$this->emit('regExportSelected');
    	$filename = $this->filenameExportSelected ?: 'equipos_seleccionados';

        $teams = Team::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
        $teams->makeHidden(['slug']);

        $this->emit('alert', ['type' => 'success', 'message' => 'Registros exportados correctamente!.']);
		return Excel::download(new TeamsExport($teams), $filename . '.' . $this->formatExport);

        // switch ($this->formatExport) {
        //     case 'xls':
        //         return (new UsersExport($users))->download($filename . '.' . $this->formatExport, \Maatwebsite\Excel\Excel::XLS);
        //         break;
        //     case 'xlsx':
        //         return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
        //         break;
        //     case 'csv':
        //         return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
        //         break;
        //     default:
        //         flash()->error('Formato de archivo no válido.');
        //         return back();
        //         break;


    // 	switch ($ext) {
    // 		case 'xlsx':
				// return Excel::download(new UsersExport, 'users.xlsx');
    // 			break;
    // 		case 'xls':
				// return Excel::download(new UsersExport, 'users.xls');
    // 			break;
    // 		case 'csv':
				// return Excel::download(new UsersExport, 'users.csv');
    // 			break;
    // 		default:
				// return Excel::download(new UsersExport, 'users.csv');
    // 			break;
    	// }
    }


    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new TeamsImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		$this->emit('alert', ['type' => 'success', 'message' => 'Registros importados correctamente!.']);
        } else {
        	$this->emit('alert', ['type' => 'error', 'message' => 'Ningún archivo seleccionado.']);
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
