<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;

class UsersTable extends Component
{
	use WithPagination;

	public $search = "";
	public $perPage = '5';
	public $order = 'id';
	public $orderDirection = 'desc';
	public $state = 'all';
	public $state_es = 'todos';
	public $addModal = false;
	public $editModal = false;

	public $user_id, $name, $email, $password;

    public function render()
    {
    	// $users = User::factory()->count(100)->create();
        return view('livewire.users.users-list', [
        			'users' => $this->getUsers()
        		])->layout('layouts.app');
    }

	private function getUsers()
	{
		$users = User::name($this->search)
	        		->orEmail($this->search)
	    			->state($this->state)
	        		->orderBy($this->order, $this->orderDirection)
	        		->paginate($this->perPage);
	    if ($users->total() > 0 && $users->count() == 0) {
			$this->page = 1;
	    	$users = User::name($this->search)
	        			->orEmail($this->search)
	    				->state($this->state)
	        			->orderBy($this->order, $this->orderDirection)
	        			->paginate($this->perPage);
		}
		return $users;
	}

	protected $queryString = [
		'search' => ['except' => ''],
		'perPage' => ['except' => '5'],
		'order' => ['except' => 'id'],
		'state' => ['except' => 'all']
	];

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

    public function cancelFilterPerPage()
    {
    	$this->perPage = '5';
    }

    public function clearAllFilters()
    {
    	$this->search = '';
    	$this->page = 1;
    	$this->perPage = '5';
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

    public function add()
    {
		$this->name = '';
		$this->email = '';
		$this->password = '';
    	$this->addModal = true;
    }

    public function store()
    {
		$this->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => 'required',
		]);

		User::create([
			'name' => $this->name,
			'email' => $this->email,
            // 'email_verified_at' => now(),
            'password' => bcrypt($this->password),
            'remember_token' => Str::random(10),
		]);

		$this->addModal = false;
    }

    public function edit($id)
    {
    	$user = User::find($id);
		$this->user_id = $user->id;
    	$this->name = $user->name;
    	$this->email = $user->email;
    	$this->password = $user->password;

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
			'password' => 'required',
		]);

    	$user = User::find($this->user_id);

    	$user->update([
			'name' => $this->name,
			'email' => $this->email,
            'password' => bcrypt($this->password),
    	]);

    	$this->editModal = false;
    }

    public function destroy($id)
    {
		User::destroy($id);
		session()->flash('message','Usuario eliminado correctamente!');
    }
}
