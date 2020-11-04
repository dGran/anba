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

	// modals
	public $addModal = false;
	public $editModal = false;
	public $confirmDestroyModal = false;
	public $selectedModal = false;
	public $filtersModal = false;

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
			$this->selectedModal = false;
		}
	}

	public function cancelSelection()
	{
		$this->regsSelectedArray = [];
	}

	public function viewSelected($view)
	{
		if (count($this->regsSelectedArray) > 0) {
			$this->selectedModal = $view;
		}
	}
	// END::Selected

	// Filters
	public function viewFilters($view)
	{
		$this->filtersModal = $view;
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
    	$this->addModal = true;
    }

    public function cancelAdd()
    {
    	$this->addModal = false;
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
    		session()->flash('message', 'Registro agregado correctamente.');
		} else {
			session()->flash('error', 'Se ha producido un error y no se han podido actualizar los datos.');
		}

		if ($this->continuousInsert) {
			$this->name = '';
			$this->email = '';
			$this->password = '';
		} else {
			$this->addModal = false;
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
    	$this->editModal = true;
    }

    public function cancelEdit()
    {
    	$this->editModal = false;
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
            	session()->flash('message', 'Registro actualizado correctamente.');
            } else {
            	session()->flash('error', 'Se ha producido un error y no se han podido actualizar los datos.');
            }
        } else {
        	session()->flash('info', 'No se han detectado cambios en el registro.');
        }

    	$this->editModal = false;
        $this->cancelSelection();
    }
    // END::Edit & Update

    public function confirmDestroy()
    {
		$this->confirmDestroyModal = true;
    }

    public function cancelDestroy()
    {
    	$this->confirmDestroyModal = false;
    }

    public function nextPage()
    {
    	$this->page++;
    }

    public function previuosPage()
    {
		$this->page--;
    }

    public function destroy($id)
    {
		$this->confirmDestroyModal = false;
		User::destroy($id);
		session()->flash('message','Usuario eliminado correctamente!.');
    }

	public function destroySelected()
	{
		foreach ($this->regsSelectedArray as $reg) {
			User::destroy($reg);
		}
		$this->confirmDestroyModal = false;
		session()->flash('message','Usuarios seleccionados eliminados correctamente!.');
		$this->regsSelectedArray = [];
	}

    public function render()
    {
    	// $users = User::factory()->count(20)->create();
        return view('livewire.admin.users.index', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected()
        		])->layout('layouts.admin');
    }

	private function getData()
	{
		$users = User::name($this->search)
	        		->orEmail($this->search)
	    			->state($this->state)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage);
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
        			->paginate($this->perPage);

		return $users;
	}

	private function getDataSelected()
	{
		return User::whereIn('id', $this->regsSelectedArray)->orderBy($this->order, $this->orderDirection)->get();
	}
}
