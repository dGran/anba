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
    public function add()
    {
		$this->name = '';
		$this->img = '';
		$this->stadium = '';

		$this->resetValidation();

    	$this->emit('addMode');
    }

    public function store()
    {
		$this->validate([
			'name' => 'required',
		]);

		$team = Team::create([
			'name' => $this->name,
			// 'img' => $this->img,
			'stadium' => $this->stadium,
			'slug' => Str::slug($this->name, '-')
		]);

		if ($team->save()) {
			$this->emit('alert', ['type' => 'success', 'message' => 'Registro agregado correctamente.']);
		} else {
			$this->emit('alert', ['type' => 'error', 'message' => 'Se ha producido un error y no se han podido actualizar los datos.']);
		}

		if ($this->continuousInsert) {
			$this->name = '';
			$this->img = '';
			$this->stadium = '';
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

    public function nextPage()
    {
    	$this->page++;
    }

    public function previuosPage()
    {
		$this->page--;
    }

    public function destroy()
    {
    	if (count($this->regsSelectedArray) > 1) {
    		$counter = 0;
			foreach ($this->regsSelectedArray as $reg) {
				if (Team::destroy($reg)) {
					$counter++;
				}
			}
			if ($counter > 0) {
				$this->emit('alert', ['type' => 'success', 'message' => 'Registros seleccionados eliminados correctamente!.']);
			} else {
				$this->emit('alert', ['type' => 'error', 'message' => 'Los registros que querías eliminar ya no existen.']);
			}
			$this->emit('regDestroy');
			$this->regsSelectedArray = [];
		} else {
			if (Team::destroy(reset($this->regsSelectedArray))) {
				$this->emit('alert', ['type' => 'success', 'message' => 'Registro eliminado correctamente!.']);
			} else {
				$this->emit('alert', ['type' => 'error', 'message' => 'El registro que querías eliminar ya no existe.']);
			}
			$this->emit('regDestroy');
		}
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

		$this->emit('alert', ['type' => 'success', 'message' => 'Registros exportados correctamente!.']);
    	return Excel::download(new TeamsExport($teams), $filename . '.' . $this->formatExport);
    }

    public function selectedExport()
    {
    	$this->emit('regExportSelected');
    	$filename = $this->filenameExportSelected ?: 'equipos_seleccionados';

        $teams = Team::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();

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
        	// (new UsersImport)->queue($this->fileImport);
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

		return $teams;
	}

	private function getDataSelected()
	{
		return Team::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
	}
}
