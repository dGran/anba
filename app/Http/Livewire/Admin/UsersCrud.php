<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;

class UsersCrud extends Component
{
	use WithPagination;

	//model info
	public $modelSingular = "usuario";
	public $modelPlural = "usuarios";
	public $modelGender = "male";
	public $modelHasImg = true;

	//filters
	public $search = "";
	public $perPage = '10';
	public $state = 'all';
	public $state_es = 'todos';
	public $order = 'id';
	public $orderDirection = 'desc';

	// general vars
	public $updateMode = false;

	//selected regs
	public $regsSelectedArray = [];

	//fields
	public $user_id, $name, $email, $password;

	//continuous insertion
	public $continuousInsert = false;

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

    public function getStateEs()
    {
    	switch ($this->state) {
    		case 'all':
    			$this->state_es = "todos";
    			break;
    		case 'active':
    			$this->state_es = "activos";
    			break;
    		case 'inactive':
    			$this->state_es = "inactivos";
    			break;
    	}
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

    public function render()
    {
    	// $users = User::factory()->count(20)->create();
        return view('livewire.admin.users.index', [
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

		return $users;
	}

	private function getDataSelected()
	{
		return User::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
	}
}
