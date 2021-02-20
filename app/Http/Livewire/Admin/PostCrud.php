<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Events\TableWasUpdated;
use App\Events\PostStored;

class PostCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "noticia";
	public $modelPlural = "noticias";
	public $modelGender = "female";
	public $modelHasImg = true;

	//fields
	public $reg_id, $type, $match_id, $statement_id, $transfer_id, $category, $title, $description, $img, $reg_img, $reg_img_formated;

	//filters
	public $search = "";
	public $perPage = '25';
	public $order = 'id_desc';
	public $filterType = "all";

	// preferences vars
	public $showTableImages;
	public $fixedFirstColumn;
	public $striped;
	public $colType;
	public $colCategory;
	public $colDescription;
	public $colDate;

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
		'filterType' => ['except' => "all"],
		'perPage' => ['except' => '25'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'posts.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'posts.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'posts.striped' => $this->striped ? 'on' : 'off',
			'posts.colType' => $this->colType ? 'on' : 'off',
			'posts.colCategory' => $this->colCategory ? 'on' : 'off',
			'posts.colDescription' => $this->colDescription ? 'on' : 'off',
			'posts.colDate' => $this->colDate ? 'on' : 'off',
		]);

		if (!$this->colType && !$this->colCategory && !$this->colDescription && !$this->colDate) {
			session(['posts.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('posts.showTableImages')) {
			$this->showTableImages = session()->get('posts.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('posts.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('posts.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}
		if (session()->get('posts.striped')) {
			$this->striped = session()->get('posts.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('posts.colType')) {
			$this->colType = session()->get('posts.colType') == 'on' ? true : false;
		} else {
			$this->colType = true;
		}
		if (session()->get('posts.colCategory')) {
			$this->colCategory = session()->get('posts.colCategory') == 'on' ? true : false;
		} else {
			$this->colCategory = true;
		}
		if (session()->get('posts.colDescription')) {
			$this->colDescription = session()->get('posts.colDescription') == 'on' ? true : false;
		} else {
			$this->colDescription = true;
		}
		if (session()->get('posts.colDate')) {
			$this->colDate = session()->get('posts.colDate') == 'on' ? true : false;
		} else {
			$this->colDate = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'posts.reg_id' => $this->reg_id,
			'posts.type' => $this->type,
			'posts.match_id' => $this->match_id,
			'posts.statement_id' => $this->statement_id,
			'posts.transfer_id' => $this->transfer_id,
			'posts.category' => $this->category,
			'posts.title' => $this->title,
			'posts.description' => $this->description,
			'posts.reg_img' => $this->reg_img,
			'posts.reg_img_formated' => $this->reg_img_formated,
			//filters
			'posts.search' => $this->search,
			'posts.perPage' => $this->perPage,
			'posts.order' => $this->order,
			'posts.page' => $this->page,
			'posts.filterType' => $this->filterType,
			'posts.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'posts.currentModal' => $this->currentModal,
			'posts.editMode' => $this->editMode,
			'posts.continuousInsert' => $this->continuousInsert,
			//selected regs
			'posts.regsSelectedArray' => $this->regsSelectedArray,
			'posts.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('posts.reg_id')) { $this->reg_id = session()->get('posts.reg_id'); }
		if (session()->get('posts.type')) { $this->type = session()->get('posts.type'); }
		if (session()->get('posts.match_id')) { $this->match_id = session()->get('posts.match_id'); }
		if (session()->get('posts.statement_id')) { $this->statement_id = session()->get('posts.statement_id'); }
		if (session()->get('posts.transfer_id')) { $this->transfer_id = session()->get('posts.transfer_id'); }
		if (session()->get('posts.category')) { $this->category = session()->get('posts.category'); }
		if (session()->get('posts.title')) { $this->title = session()->get('posts.title'); }
		if (session()->get('posts.description')) { $this->description = session()->get('posts.description'); }
		if (session()->get('posts.reg_img')) { $this->reg_img = session()->get('posts.reg_img'); }
		if (session()->get('posts.reg_img_formated')) { $this->reg_img_formated = session()->get('posts.reg_img_formated'); }
		//filters
		if (session()->get('posts.search')) { $this->search = session()->get('posts.search'); }
		if (session()->get('posts.perPage')) { $this->perPage = session()->get('posts.perPage'); }
		if (session()->get('posts.order')) { $this->order = session()->get('posts.order'); }
		if (session()->get('posts.page')) { $this->page = session()->get('posts.page'); }
		if (session()->get('posts.filterType')) { $this->filterType = session()->get('posts.filterType'); }
		if (session()->get('posts.regsSelectedArray')) { $this->regsSelectedArray = session()->get('posts.regsSelectedArray'); }
		// general vars
		if (session()->get('posts.currentModal')) { $this->currentModal = session()->get('posts.currentModal'); }
		if (session()->get('posts.editMode')) { $this->editMode = session()->get('posts.editMode'); }
		if (session()->get('posts.continuousInsert')) { $this->continuousInsert = session()->get('posts.continuousInsert'); }
		//selected regs
		if (session()->get('posts.regsSelectedArray')) { $this->regsSelectedArray = session()->get('posts.regsSelectedArray'); }
		if (session()->get('posts.checkAllSelector')) { $this->checkAllSelector = session()->get('posts.checkAllSelector'); }
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
    	$regs = Post::
    		name($this->search)
    		->type($this->filterType)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
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

    public function cancelFilterType()
    {
    	$this->filterType = "all";
    }

    public function setFilterPerPage($number)
    {
    	$this->perPage = $number;
    }

    public function cancelFilterPerPage()
    {
    	$this->perPage = '25';
    }

    public function clearAllFilters()
    {
    	$this->search = '';
    	$this->page = 1;
    	$this->perPage = '25';
		$this->order = 'id_desc';
		$this->filterType = "all";

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->type = null;
		$this->match_id = null;
		$this->statement_id = null;
		$this->transfer_id = null;
		$this->category = null;
		$this->title = null;
		$this->description = null;
		$this->img = null;
		$this->reg_img = null;
		$this->reg_img_formated = null;
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
	       		'type' => 'required',
	       		'category' => 'required',
	       		'title' => 'required',
	       		'description' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'type.required' => 'El tipo es obligatorio',
		    	'category.required' => 'La categoría es obligatoria',
		    	'title.required' => 'El título es obligatorio',
		    	'description.required' => 'La descripción es obligatoria',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('posts', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	        	'type' => 'required',
	       		'category' => 'required',
	       		'title' => 'required',
	       		'description' => 'required',
	        ],
		    [
		    	'type.required' => 'El tipo es obligatorio',
		    	'category.required' => 'La categoría es obligatoria',
		    	'title.required' => 'El título es obligatorio',
		    	'description.required' => 'La descripción es obligatoria',
	        ]);
	    }
	    $validatedData['type'] = $this->type;
        $validatedData['slug'] = Str::slug($this->title, '-');

        $reg = Post::create($validatedData);

        event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT)));
        event(new PostStored($reg));
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

    	$reg = Post::find($id);

		$this->reg_id = $reg->id;
    	$this->type = $reg->type;
    	$this->match_id = $reg->match_id;
    	$this->statement_id = $reg->statement_id;
    	$this->transfer_id = $reg->transfer_id;
		$this->category = $reg->category;
		$this->title = $reg->title;
		$this->description = $reg->description;
    	$this->reg_img = $reg->img;
		$this->reg_img_formated = $reg->getImg();

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Post::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        if ($this->img) {
	        $validatedData = $this->validate([
	        	'type' => 'required',
	       		'category' => 'required',
	       		'title' => 'required',
	       		'description' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'type.required' => 'El tipo es obligatorio',
		    	'category.required' => 'La categoría es obligatoria',
		    	'title.required' => 'El título es obligatorio',
		    	'description.required' => 'La descripción es obligatoria',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        Storage::disk('public')->delete($reg->img);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('posts', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	        	'type' => 'required',
	       		'category' => 'required',
	       		'title' => 'required',
	       		'description' => 'required',
	        ],
		    [
		    	'type.required' => 'El tipo es obligatorio',
		    	'category.required' => 'La categoría es obligatoria',
		    	'title.required' => 'El título es obligatorio',
		    	'description.required' => 'La descripción es obligatoria',
	        ]);

	        if (is_null($this->reg_img)) {
				Storage::disk('public')->delete($reg->img);
	        	$validatedData['img'] = null;
	        }
	    }
	    $validatedData['type'] = $this->type;
        $validatedData['slug'] = Str::slug($this->title, '-');

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
			if ($reg = Post::find($reg)) {
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
    	$this->regView = Post::find($id);
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
	            if ($original = Post::find($reg)) {
	            	$counter++;
	                $reg = $original->replicate();
	            	$random_number = rand(100,999);
	            	$random_text = "_copia_" . $random_number;
	            	$reg->title .= $random_text;
	            	if ($reg->storageImg()) {
	            		$pos = strpos($reg->img, '.');
	            		$original_img_name = substr($reg->img, 0, $pos);
	            		$original_img_ext = substr($reg->img, $pos, strlen($reg->img) - $pos);
	            		$img_name = $original_img_name . $random_text . $original_img_ext;
						Storage::disk('public')->copy($reg->img, $img_name);
						$reg->img = $img_name;
	            	}
	            	$reg->slug = Str::slug($reg->title, '-');
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
            if ($original = Post::find(reset($this->regsSelectedArray))) {
                $reg = $original->replicate();
            	$random_number = rand(100,999);
            	$random_text = "_copia_" . $random_number;
            	$reg->title .= $random_text;
            	if ($reg->storageImg()) {
            		$pos = strpos($reg->img, '.');
            		$original_img_name = substr($reg->img, 0, $pos);
            		$original_img_ext = substr($reg->img, $pos, strlen($reg->img) - $pos);
            		$img_name = $original_img_name . $random_text . $original_img_ext;
					Storage::disk('public')->copy($reg->img, $img_name);
					$reg->img = $img_name;
            	}
            	$reg->slug = Str::slug($reg->title, '-');
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

    	$filename = $this->filenameExportTable ?: 'noticias';

    	$regs = Post::
    		name($this->search)
    		->type($this->filterType)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
    		->get();

		$regs->makeHidden(['slug', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new PostsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'noticias_seleccionadas';

    	$regs = Post::
    		whereIn('posts.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
        	->get();
        $regs->makeHidden(['slug', 'created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new PostsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new PostsImport, $this->fileImport);
        	// (new postsImport)->queue($this->fileImport);
    		session()->flash('success', 'Registros importados correctamente!.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
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

        return view('admin.posts', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Post::
    		name($this->search)
    		->type($this->filterType)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Post::
    		name($this->search)
    		->type($this->filterType)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Post::
    		name($this->search)
    		->type($this->filterType)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
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
		return Post::
			whereIn('posts.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('posts.title', 'asc')
			->get();
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
            'type' => [
                'field'     => 'posts.type',
                'direction' => 'asc'
            ],
            'type_desc' => [
                'field'     => 'posts.type',
                'direction' => 'desc'
            ],
            'category' => [
                'field'     => 'posts.category',
                'direction' => 'asc'
            ],
            'category_desc' => [
                'field'     => 'posts.category',
                'direction' => 'desc'
            ],
            'title' => [
                'field'     => 'posts.title',
                'direction' => 'asc'
            ],
            'title_desc' => [
                'field'     => 'posts.title',
                'direction' => 'desc'
            ],
            'date' => [
                'field'     => 'posts.created_at',
                'direction' => 'asc'
            ],
            'date_desc' => [
                'field'     => 'posts.created_at',
                'direction' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'posts.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}