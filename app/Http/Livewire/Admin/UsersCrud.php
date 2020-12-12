<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UsersCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	//model info
	public $modelSingular = "usuario";
	public $modelPlural = "usuarios";
	public $modelGender = "male";
	public $modelHasImg = true;

	//filters
	public $search = "";
	public $perPage = '10';
	public $state = 'all';
	public $order = 'id';
	public $orderDirection = 'desc';

	// general vars
	public $updateMode = false;

	//selected regs
	public $regsSelectedArray = [];
	public $checkAllSelector = 0;

	//fields
	public $user_id, $name, $email, $password;

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
		'order' => ['except' => 'id'],
		'state' => ['except' => 'all']
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
		$users = User::name($this->search)
	        		->orEmail($this->search)
	    			->state($this->state)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage, ['*'], 'page', $this->page);
		foreach ($users as $user) {
			if ($this->checkAllSelector == 1) {
				$this->regsSelectedArray[$user->id] = $user->id;
			} else {
				$array_id = array_search($user->id, $this->regsSelectedArray);
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

    public function cancelFilterState()
    {
    	$this->state = 'all';
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
		$this->state = 'all';
    }

    // Add & Store
    public function add()
    {
		$this->name = '';
		$this->email = '';
		$this->password = '';

		$this->resetValidation();

		$this->updateMode = false;
    	$this->emit('addMode');
    }

    public function store()
    {
		$this->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => 'required',
		]);

		$user = User::create([
			'name' => $this->name,
			'email' => $this->email,
            // 'email_verified_at' => now(),
            'password' => bcrypt($this->password),
            'remember_token' => Str::random(10),
		]);

		if ($user->save()) {
			$this->emit('alert', ['type' => 'success', 'message' => 'Registro agregado correctamente.']);
		} else {
			$this->emit('alert', ['type' => 'error', 'message' => 'Se ha producido un error y no se han podido actualizar los datos.']);
		}

		if ($this->continuousInsert) {
			$this->name = '';
			$this->email = '';
			$this->password = '';
		} else {
			$this->emit('regStore');
		}
    }
    // END::Add & Store

	// Edit & Update
    public function edit($id)
    {
    	$user = User::find($id);
		$this->user_id = $user->id;
    	$this->name = $user->name;
    	$this->email = $user->email;
    	$this->password = $user->password;

		$this->resetValidation();

		$this->updateMode = true;
    	$this->emit('editMode');
    }

    public function update()
    {
		$this->validate([
			'name' => 'required',
			'email' => 'required',
		]);

    	$user = User::find($this->user_id);

		$user->name = $this->name;
		$user->email = $this->email;

        if ($user->isDirty()) {
            if ($user->update()) {
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
    	if (count($this->regsSelectedArray) > 1) {
    		$counter = 0;
			foreach ($this->regsSelectedArray as $reg) {
				if (User::destroy($reg)) {
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
			if (User::destroy(reset($this->regsSelectedArray))) {
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
	            $original = User::find($reg);
	            if ($original) {
	            	$counter++;
	                $user = $original->replicate();
                	$random_numer = rand(100,999);
                	$user->name .= " (copia_" . $random_numer . ")";
                	$user->email .= " (copia_" . $random_numer . ")";
	                $user->save();
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
            $original = User::find(reset($this->regsSelectedArray));
            if ($original) {
                $user = $original->replicate();
            	$random_numer = rand(100,999);
            	$user->name .= " (copia_" . $random_numer . ")";
            	$user->email .= " (copia_" . $random_numer . ")";
                $user->save();
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
    	$filename = $this->filenameExportTable ?: 'usuarios';

		$users = User::name($this->search)
	        		->orEmail($this->search)
	    			->state($this->state)
	        		->orderBy($this->order, $this->orderDirection)
	        		->get();

		$this->emit('alert', ['type' => 'success', 'message' => 'Registros exportados correctamente!.']);
    	return Excel::download(new UsersExport($users), $filename . '.' . $this->formatExport);
    }

    public function selectedExport()
    {
    	$this->emit('regExportSelected');
    	$filename = $this->filenameExportSelected ?: 'usuarios_seleccionados';

        $users = User::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();

        $this->emit('alert', ['type' => 'success', 'message' => 'Registros exportados correctamente!.']);
		return Excel::download(new UsersExport($users), $filename . '.' . $this->formatExport);

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
        	Excel::import(new UsersImport, $this->fileImport);
        	// (new UsersImport)->queue($this->fileImport);
    		$this->emit('alert', ['type' => 'success', 'message' => 'Registros importados correctamente!.']);
        } else {
        	$this->emit('alert', ['type' => 'error', 'message' => 'Ningún archivo seleccionado.']);
        }
    	$this->emit('regImport');
    }

    public function render()
    {
    	// $users = User::factory()->count(20)->create();
        return view('admin.users', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected()
        		])->layout('adminlte::page');
    }

	private function getData()
	{
		$users = User::name($this->search)
	        		->orEmail($this->search)
	    			->state($this->state)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage)->onEachSide(2);
	    if (($users->total() > 0 && $users->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $users->lastPage();
		}
    	$users = User::name($this->search)
        			->orEmail($this->search)
    				->state($this->state)
        			->orderBy($this->order, $this->orderDirection)
        			->paginate($this->perPage)->onEachSide(2);

		$this->setCheckAllSelector();
		return $users;
	}

	public function setCheckAllSelector()
	{
		$users = User::name($this->search)
        			->orEmail($this->search)
    				->state($this->state)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage, ['*'], 'page', $this->page);

		$this->checkAllSelector = 1;
		foreach ($users as $user) {
			$array_id = array_search($user->id, $this->regsSelectedArray);
			if (!$array_id) {
				$this->checkAllSelector = 0;
			}
		}
	}

	private function getDataSelected()
	{
		return User::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
	}
}
