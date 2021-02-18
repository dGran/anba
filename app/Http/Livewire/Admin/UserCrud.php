<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\ConferencesExport;
use App\Imports\ConferencesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Events\TableWasUpdated;

class UserCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "usuario";
	public $modelPlural = "usuarios";
	public $modelGender = "male";
	public $modelHasImg = true;

	//fields
	public $reg_id, $name, $email, $password, $img, $reg_img, $reg_img_formated, $state;

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterState = "all";
	public $order = 'id_desc';

	// preferences vars
	public $striped;
	public $showTableImages;
	public $colEmail;

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
		'filterState' => ['except' => "all"],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'users.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'users.striped' => $this->striped ? 'on' : 'off',
			'users.colEmail' => $this->colEmail ? 'on' : 'off',
		]);
	}

	protected function getSessionPreferences()
	{
		if (session()->get('users.showTableImages')) {
			$this->showTableImages = session()->get('users.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('users.striped')) {
			$this->striped = session()->get('users.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('users.colEmail')) {
			$this->colEmail = session()->get('users.colEmail') == 'on' ? true : false;
		} else {
			$this->colEmail = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'users.reg_id' => $this->reg_id,
			'users.name' => $this->name,
			'users.email' => $this->email,
			'users.password' => $this->password,
			'users.reg_img' => $this->reg_img,
			'users.reg_img_formated' => $this->reg_img_formated,
			'users.state' => $this->state,
			//filters
			'users.search' => $this->search,
			'users.perPage' => $this->perPage,
			'users.filterState' => $this->filterState,
			'users.order' => $this->order,
			'users.page' => $this->page,
			'users.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'users.currentModal' => $this->currentModal,
			'users.editMode' => $this->editMode,
			'users.continuousInsert' => $this->continuousInsert,
			//selected regs
			'users.regsSelectedArray' => $this->regsSelectedArray,
			'users.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('users.reg_id')) { $this->reg_id = session()->get('users.reg_id'); }
		if (session()->get('users.name')) { $this->name = session()->get('users.name'); }
		if (session()->get('users.email')) { $this->email = session()->get('users.email'); }
		if (session()->get('users.password')) { $this->password = session()->get('users.password'); }
		if (session()->get('users.reg_img')) { $this->reg_img = session()->get('users.reg_img'); }
		if (session()->get('users.reg_img_formated')) { $this->reg_img_formated = session()->get('users.reg_img_formated'); }
		if (session()->get('users.state')) { $this->state = session()->get('users.state'); }
		//filters
		if (session()->get('users.search')) { $this->search = session()->get('users.search'); }
		if (session()->get('users.perPage')) { $this->perPage = session()->get('users.perPage'); }
		if (session()->get('users.filterState')) { $this->filterState = session()->get('users.filterState'); }
		if (session()->get('users.order')) { $this->order = session()->get('users.order'); }
		if (session()->get('users.page')) { $this->page = session()->get('users.page'); }
		if (session()->get('users.regsSelectedArray')) { $this->regsSelectedArray = session()->get('users.regsSelectedArray'); }
		// general vars
		if (session()->get('users.currentModal')) { $this->currentModal = session()->get('users.currentModal'); }
		if (session()->get('users.editMode')) { $this->editMode = session()->get('users.editMode'); }
		if (session()->get('users.continuousInsert')) { $this->continuousInsert = session()->get('users.continuousInsert'); }
		//selected regs
		if (session()->get('users.regsSelectedArray')) { $this->regsSelectedArray = session()->get('users.regsSelectedArray'); }
		if (session()->get('users.checkAllSelector')) { $this->checkAllSelector = session()->get('users.checkAllSelector'); }
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
    	$regs = User::
    		select('users.*')
    		->name($this->search)
			->state($this->filterState)
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

    public function cancelFilterState()
    {
		$this->filterState = "all";
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
		$this->filterState = "all";

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
		$this->email = null;
		$this->password = null;
		$this->img = null;
		$this->reg_img = null;
		$this->reg_img_formated = null;
		$this->state = 0;
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
	       		'email' => 'required|unique:users,email',
	       		'name' => 'required',
	       		'password' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'email.required' => 'El email es obligatorio',
		    	'email.unique' => 'El existe un registro con el mismo email',
		    	'name.required' => 'El nombre es obligatorio',
		    	'password.required' => 'La contraseña es obligatoria',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['profile_photo_path'] = $this->img->storeAs('profile-photos', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	       		'email' => 'required|unique:users,email',
	       		'name' => 'required',
	       		'password' => 'required',
	        ],
		    [
		    	'email.required' => 'El email es obligatorio',
		    	'email.unique' => 'El existe un registro con el mismo email',
		    	'name.required' => 'El nombre es obligatorio',
		    	'password.required' => 'La contraseña es obligatoria',
	        ]);
	    }
	    if ($this->state) {
	    	$validatedData['email_verified_at'] = now();
	    }
		$validatedData['password'] = Hash::make($this->password);
        // $validatedData['slug'] = Str::slug($this->name, '-');

        $reg = User::create($validatedData);

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

    	$reg = User::find($id);
		$this->reg_id = $reg->id;
    	$this->name = $reg->name;
    	$this->email = $reg->email;
    	$this->password = $reg->password;
    	$this->reg_img = $reg->img;
		$this->reg_img_formated = $reg->getImg();
		if ($reg->email_verified_at) {
			$this->state = 1;
		} else {
			$this->state = 0;
		}

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = User::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        if ($this->img) {
	        $validatedData = $this->validate([
	       		'email' => 'required|unique:users,email,' . $reg->id,
	       		'name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'email.required' => 'El email es obligatorio',
		    	'email.unique' => 'El existe un registro con el mismo email',
		    	'name.required' => 'El nombre es obligatorio',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        Storage::disk('public')->delete($reg->img);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['profile_photo_path'] = $this->img->storeAs('profile-photos', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	       		'email' => 'required|unique:users,email,' . $reg->id,
	       		'name' => 'required',
	        ],
		    [
		    	'email.required' => 'El email es obligatorio',
		    	'email.unique' => 'El existe un registro con el mismo email',
		    	'name.required' => 'El nombre es obligatorio',
	        ]);

	        if (is_null($this->reg_img)) {
				Storage::disk('public')->delete($reg->img);
	        	$validatedData['img'] = null;
	        }
	    }

	    if ($this->state) {
	    	if ($reg->email_verified_at) {
				$validatedData['email_verified_at'] = $reg->email_verified_at;
	    	} else {
	    		$validatedData['email_verified_at'] = now();
	    	}
	    } else {
	    	$validatedData['email_verified_at'] = null;
	    }
        // $validatedData['slug'] = Str::slug($this->name, '-');

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
			if ($reg = User::find($reg)) {
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
    	$this->regView = User::find($id);
    	$this->emit('openViewModal');
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

    	$filename = $this->filenameExportTable ?: 'usuarios';

    	$regs = User::
    		select('users.*')
    		->name($this->search)
			->state($this->filterState)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
    		->get();

		$regs->makeHidden(['slug', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new UsersExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'usuarios_seleccionadas';

    	$regs = User::
    		select('users.*')
    		->whereIn('users.id', $this->regsSelectedArray)
        	->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
        	->get();
        $regs->makeHidden(['slug', 'created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new UsersExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new UsersImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		session()->flash('success', 'Registros importados correctamente!.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
    }

	// Update fields
    public function verify($id, $state)
    {
    	$reg = User::find($id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);
    	if ($state) {
    		$reg->email_verified_at = now();
    	} else {
    		$reg->email_verified_at = null;
    	}
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

        return view('admin.users', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'filterStateName' => $this->filterStateName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = User::
    		select('users.*')
    		->name($this->search)
			->state($this->filterState)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = User::
    		select('users.*')
    		->name($this->search)
			->state($this->filterState)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = User::
    		select('users.*')
    		->name($this->search)
			->state($this->filterState)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage, ['*'], 'page', $this->page);

		$this->checkAllSelector = 1;
		foreach ($regs as $reg) {
			$array_id = array_search($reg->id, $this->regsSelectedArray);
			if (!$array_id) {
				$this->checkAllSelector = 0;
			}
		}
	}

	protected function getDataSelected()
	{
		return User::
    		select('users.*')
			->whereIn('users.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->get();
	}

	protected function filterStateName()
	{
		if ($this->filterState != "all") {
			return $this->filterState == "verified" ? 'Verificados' : 'No verificados';
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
                'field'     => 'users.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'users.name',
                'direction' => 'desc'
            ],
            'email' => [
                'field'     => 'users.email',
                'direction' => 'asc'
            ],
            'email_desc' => [
                'field'     => 'users.email',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'users.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}