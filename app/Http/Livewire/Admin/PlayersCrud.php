<?php

namespace App\Http\Livewire\Admin;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\PlayersExport;
use App\Imports\PlayersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Events\RegWasSaved;
use App\Events\RegWasDeleted;

class PlayersCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "jugador";
	public $modelPlural = "jugadores";
	public $modelGender = "male";
	public $modelHasImg = true;

	//fields
	public $reg_id, $name, $nickname, $team_id, $img, $reg_img, $reg_img_formated, $position, $height, $weight, $college, $birthdate, $nation_name, $draft_year, $average, $retired;

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterPosition = "all";
	public $filterTeam = "all";
	public $filterHeight = ['from' => 5, 'to' => 8];
	public $filterWeight = ['from' => 125, 'to' => 500];
	public $filterCollege = "all";
	public $filterNation = "all";
	public $filterAge = ['from' => 15, 'to' => 45];
	public $filterYearDraft = ['from' => 1995, 'to' => 2020];
	public $filterRetired = -1;
	public $order = 'id_desc';

	// preferences vars
	public $striped;
	public $fixedFirstColumn;
	public $showTableImages;
	public $showNicknames;
	public $colTeam;
	public $colPosition;
	public $colNation;
	public $colAge;
	public $colHeight;
	public $colWeight;
	public $colDraftYear;
	public $colCollege;

	// general vars
	public $editMode = false;
	public $continuousInsert = false;
	public $regView;
	public $teamTransfer;
	//selected regs
	public $regsSelectedArray = [];
	public $checkAllSelector = 0;
	//import & export
	public $fileImport;
	public $formatExport = '';
	public $filenameExportTable = '';
	public $filenameExportSelected = '';

	//queryString
	protected $queryString = [
		'search' => ['except' => ''],
		'filterPosition' => ['except' => "all"],
		'filterTeam' => ['except' => "all"],
		'filterHeight' => ['except' => 	['from' => 5, 'to' => 8]],
		'filterWeight' => ['except' => 	['from' => 125, 'to' => 500]],
		'filterCollege' => ['except' => "all"],
		'filterNation' => ['except' => "all"],
		'filterAge' => ['except' => ['from' => 15, 'to' => 45]],
		'filterYearDraft' => ['except' => ['from' => 1995, 'to' => 2020]],
		'filterRetired' => ['except' => -1],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'players.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'players.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'players.striped' => $this->striped ? 'on' : 'off',
			'players.showNicknames' => $this->showNicknames ? 'on' : 'off',
			'players.colTeam' => $this->colTeam ? 'on' : 'off',
			'players.colPosition' => $this->colPosition ? 'on' : 'off',
			'players.colNation' => $this->colNation ? 'on' : 'off',
			'players.colAge' => $this->colAge ? 'on' : 'off',
			'players.colHeight' => $this->colHeight ? 'on' : 'off',
			'players.colWeight' => $this->colWeight ? 'on' : 'off',
			'players.colDraftYear' => $this->colDraftYear ? 'on' : 'off',
			'players.colCollege' => $this->colCollege ? 'on' : 'off'
		]);

		if (!$this->colTeam && !$this->colPosition && !$this->colNation && !$this->colAge && !$this->colHeight && !$this->colWeight && !$this->colDraftYear && !$this->colCollege) {
			session(['players.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('players.showTableImages')) {
			$this->showTableImages = session()->get('players.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('players.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('players.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}
		if (session()->get('players.striped')) {
			$this->striped = session()->get('players.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('players.showNicknames')) {
			$this->showNicknames = session()->get('players.showNicknames') == 'on' ? true : false;
		} else {
			$this->showNicknames = true;
		}
		if (session()->get('players.colTeam')) {
			$this->colTeam = session()->get('players.colTeam') == 'on' ? true : false;
		} else {
			$this->colTeam = true;
		}
		if (session()->get('players.colPosition')) {
			$this->colPosition = session()->get('players.colPosition') == 'on' ? true : false;
		} else {
			$this->colPosition = true;
		}
		if (session()->get('players.colNation')) {
			$this->colNation = session()->get('players.colNation') == 'on' ? true : false;
		} else {
			$this->colNation = true;
		}
		if (session()->get('players.colAge')) {
			$this->colAge = session()->get('players.colAge') == 'on' ? true : false;
		} else {
			$this->colAge = true;
		}
		if (session()->get('players.colHeight')) {
			$this->colHeight = session()->get('players.colHeight') == 'on' ? true : false;
		} else {
			$this->colHeight = true;
		}
		if (session()->get('players.colWeight')) {
			$this->colWeight = session()->get('players.colWeight') == 'on' ? true : false;
		} else {
			$this->colWeight = true;
		}
		if (session()->get('players.colDraftYear')) {
			$this->colDraftYear = session()->get('players.colDraftYear') == 'on' ? true : false;
		} else {
			$this->colDraftYear = true;
		}
		if (session()->get('players.colCollege')) {
			$this->colCollege = session()->get('players.colCollege') == 'on' ? true : false;
		} else {
			$this->colCollege = true;
		}
	}

	protected function setSessionFilters()
	{
		session([
			'players.search' => $this->search,
			'players.perPage' => $this->perPage,
			'players.filterPosition' => $this->filterPosition,
			'players.filterTeam' => $this->filterTeam,
			'players.filterHeight' => $this->filterHeight,
			'players.filterWeight' => $this->filterWeight,
			'players.filterCollege' => $this->filterCollege,
			'players.filterNation' => $this->filterNation,
			'players.filterAge' => $this->filterAge,
			'players.filterYearDraft' => $this->filterYearDraft,
			'players.filterRetired' => $this->filterRetired,
			'players.order' => $this->order,
			'players.page' => $this->page,
			'players.regsSelectedArray' => $this->regsSelectedArray,
		]);
	}

	protected function getSessionFilters()
	{
		if (session()->get('players.search')) { $this->search = session()->get('players.search'); }
		if (session()->get('players.perPage')) { $this->perPage = session()->get('players.perPage'); }
		if (session()->get('players.filterPosition')) { $this->filterPosition = session()->get('players.filterPosition'); }
		if (session()->get('players.filterTeam')) { $this->filterTeam = session()->get('players.filterTeam'); }
		if (session()->get('players.filterHeight')) { $this->filterHeight = session()->get('players.filterHeight'); }
		if (session()->get('players.filterWeight')) { $this->filterWeight = session()->get('players.filterWeight'); }
		if (session()->get('players.filterCollege')) { $this->filterCollege = session()->get('players.filterCollege'); }
		if (session()->get('players.filterNation')) { $this->filterNation = session()->get('players.filterNation'); }
		if (session()->get('players.filterAge')) { $this->filterAge = session()->get('players.filterAge'); }
		if (session()->get('players.filterYearDraft')) { $this->filterYearDraft = session()->get('players.filterYearDraft'); }
		if (session()->get('players.filterRetired')) { $this->filterRetired = session()->get('players.filterRetired'); }
		if (session()->get('players.order')) { $this->order = session()->get('players.order'); }
		if (session()->get('players.page')) { $this->page = session()->get('players.page'); }
		if (session()->get('players.regsSelectedArray')) { $this->regsSelectedArray = session()->get('players.regsSelectedArray'); }
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
    	$regs = Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
    		->name($this->search)
    		->team($this->filterTeam)
			->position($this->filterPosition)
			->height($this->filterHeight)
			->weight($this->filterWeight)
			->college($this->filterCollege)
			->nation($this->filterNation)
			->age($this->filterAge)
			->yearDraft($this->filterYearDraft)
			->retired($this->filterRetired)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('players.name', 'asc')
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
	// END::Selected

	// Filters
	public function viewFilters($view)
	{
		if ($view) {
			$this->emit('openFiltersModal');
		} else {
			$this->emit('closeFiltersModal');
		}
	}

    public function order($name)
    {
    	$this->order = $name;
    	$this->page = 1;
    }

    public function cancelFilterSearch()
    {
    	$this->search = '';
    }

    public function cancelFilterPosition()
    {
    	$this->filterPosition = "all";
    }

    public function cancelFilterTeam()
    {
    	$this->filterTeam = "all";
    }

    public function cancelFilterHeight()
    {
    	$this->filterHeight = ['from' => 5, 'to' => 8];
    }

    public function cancelFilterWeight()
    {
    	$this->filterWeight = ['from' => 125, 'to' => 500];
    }

    public function cancelFilterCollege()
    {
    	$this->filterCollege = "all";
    }

    public function cancelFilterNation()
    {
    	$this->filterNation = "all";
    }

    public function cancelFilterAge()
    {
    	$this->filterAge = ['from' => 15, 'to' => 45];
    }

    public function cancelFilterYearDraft()
    {
		$this->filterYearDraft = ['from' => 1995, 'to' => 2020];
    }

    public function cancelFilterRetired()
    {
		$this->filterRetired = -1;
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
		$this->filterPosition = "all";
		$this->filterTeam = "all";
		$this->filterHeight = ['from' => 5, 'to' => 8];
		$this->filterWeight = ['from' => 125, 'to' => 500];
		$this->filterAge = ['from' => 15, 'to' => 45];
		$this->filterYearDraft = ['from' => 1995, 'to' => 2020];
		$this->filterCollege = "all";
		$this->filterNation = "all";
		$this->filterRetired = -1;

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
		$this->nickname = null;
		$this->team_id = null;
		$this->img = null;
		$this->reg_img = null;
		$this->reg_img_formated = null;
		$this->position = null;
		$this->height = null;
		$this->weight = null;
		$this->college = null;
		$this->birthdate = null;
		$this->nation_name = null;
		$this->draft_year = null;
		$this->average = null;
		$this->retired = 0;
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

    	$this->editMode = false;
    }

    public function store()
    {
        if ($this->img) {
	       $validatedData = $this->validate([
	       		'name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('players', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	            'name' => 'required'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio'
	        ]);
	    }
	    $validatedData['nickname'] = $this->nickname;
		$validatedData['team_id'] = $this->team_id ?: null;
		$validatedData['position'] = $this->position;
		$validatedData['height'] = $this->height;
		$validatedData['weight'] = $this->weight;
		$validatedData['college'] = $this->college ?: null;
		$validatedData['birthdate'] = $this->birthdate;
		$validatedData['nation_name'] = $this->nation_name ?: null;
		$validatedData['draft_year'] = $this->draft_year;
		$validatedData['average'] = $this->average;
		$validatedData['retired'] = $this->retired;
		if ($this->retired) {
			$validatedData['team_id'] = null;
		}
        $validatedData['slug'] = Str::slug($this->name, '-');

        $reg = Player::create($validatedData);

        event(new RegWasSaved($reg, $reg->name));
        session()->flash('success', 'Registro agregado correctamente.');

		if ($this->continuousInsert) {
			$this->resetFields();
		} else {
			$this->resetFields();
			$this->emit('closeAddModal');
		}
    }
    // END::Add & Store

	// Edit & Update
    public function edit($id)
    {
    	$this->resetFields();
		$this->resetValidation();

    	$reg = Player::find($id);
		$this->reg_id = $reg->id;
    	$this->name = $reg->name;
    	$this->nickname = $reg->nickname;
    	$this->team_id = $reg->team_id;
    	$this->reg_img = $reg->img;
		$this->reg_img_formated = $reg->getImg();
		$this->position = $reg->position;
		$this->height = $reg->height;
		$this->weight = $reg->weight;
		$this->college = $reg->college;
		$this->birthdate = $reg->birthdate;
		$this->nation_name = $reg->nation_name;
		$this->draft_year = $reg->draft_year;
		$this->average = $reg->average;
		$this->retired = $reg->retired;

    	$this->emit('openEditModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Player::find($this->reg_id);

        if ($this->img) {
	        $validatedData = $this->validate([
	       		'name' => 'required',
	            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
	            // 'img' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio',
	            'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
	            'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes',
	            // 'img.dimensions' => 'La imagen debe ser proporcinal, ratio 1:1'
	        ]);
	        Storage::disk('public')->delete($reg->img);
	        $fileName = time() . '.' . $this->img->extension();
	        $validatedData['img'] = $this->img->storeAs('players', $fileName, 'public');
	    } else {
	        $validatedData = $this->validate([
	            'name' => 'required'
	        ],
		    [
		    	'name.required' => 'El nombre es obligatorio'
	        ]);

	        if (is_null($this->reg_img)) {
				Storage::disk('public')->delete($reg->img);
	        	$validatedData['img'] = null;
	        }
	    }
	    $validatedData['nickname'] = $this->nickname;
	    $validatedData['team_id'] = $this->team_id ?: null;
		$validatedData['position'] = $this->position;
		$validatedData['height'] = $this->height;
		$validatedData['weight'] = $this->weight;
		$validatedData['college'] = $this->college ?: null;
		$validatedData['birthdate'] = $this->birthdate;
		$validatedData['nation_name'] = $this->nation_name ?: null;
		$validatedData['draft_year'] = $this->draft_year;
		$validatedData['average'] = $this->average;
		$validatedData['retired'] = $this->retired;
		if ($this->retired) {
			$validatedData['team_id'] = null;
		}
        $validatedData['slug'] = Str::slug($this->name, '-');

		$reg->fill($validatedData);

        if ($reg->isDirty()) {
            if ($reg->update()) {
            	session()->flash('success', 'Registro actualizado correctamente.');
            } else {
            	session()->flash('error', 'Se ha producido un error y no se han podido actualizar los datos.');
            }
        } else {
        	session()->flash('info', 'No se han detectado cambios en el registro.');
        }

        $this->emit('closeEditModal');

        $this->cancelSelection();
		$this->resetFields();
    }
    // END::Edit & Update


    public function confirmDestroy()
    {
		$this->emit('openDestroyModal');
    }

    public function destroy()
    {
    	$regs_to_delete = count($this->regsSelectedArray);
		$regs_deleted = 0;
		foreach ($this->regsSelectedArray as $reg) {
			if ($reg = Player::find($reg)) {
				$storageImg = $reg->img;
				if ($reg->canDestroy()) {
					event(new RegWasDeleted($reg, $reg->name));
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

    public function view($id)
    {
    	$this->regView = Player::find($id);
    	$this->emit('openViewModal');
    }

    public function confirmDuplicate()
    {
		$this->emit('openDuplicateModal');
    }

    public function duplicate()
    {
    	if (count($this->regsSelectedArray) > 1) {
    		$counter = 0;
			foreach ($this->regsSelectedArray as $reg) {
	            if ($original = Player::find($reg)) {
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
	                $reg->save();
	            }
			}
			if ($counter > 0) {
				session()->flash('success', 'Registros seleccionados duplicados correctamente!.');
			} else {
				session()->flash('error', 'Los registros que querías duplicar ya no existen.');
			}
			$this->emit('closeDuplicateModal');
		} elseif (count($this->regsSelectedArray) == 1) {
            if ($original = Player::find(reset($this->regsSelectedArray))) {
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
                $reg->save();
                session()->flash('success', 'Registro duplicado correctamente!.');
            } else {
            	session()->flash('error', 'El registro que querías duplicar ya no existe.');
            }
			$this->emit('closeDuplicateModal');
		}

		$this->regsSelectedArray = [];
    }

    public function confirmExportTable($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportTableModal');
    }

    public function tableExport()
    {
    	$this->emit('closeExportTableModal');

    	$filename = $this->filenameExportTable ?: 'jugadores';

    	$regs = Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
    		->name($this->search)
    		->team($this->filterTeam)
			->position($this->filterPosition)
			->height($this->filterHeight)
			->weight($this->filterWeight)
			->college($this->filterCollege)
			->nation($this->filterNation)
			->age($this->filterAge)
			->yearDraft($this->filterYearDraft)
			->retired($this->filterRetired)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('players.name', 'asc')
    		->get();

		$regs->makeHidden(['slug', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new PlayersExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'jugadores_seleccionados';

    	$regs = Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
    		->whereIn('players.id', $this->regsSelectedArray)
        	->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
        	->orderBy('players.name', 'asc')
        	->get();
        $regs->makeHidden(['slug']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new PlayersExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new PlayersImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		session()->flash('success', 'Registros importados correctamente!.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
    }

    public function confirmTransfer()
    {
		$this->emit('openTransfersModal');
    }

    public function transfer()
    {
    	if (count($this->regsSelectedArray) > 1) {
    		$counter = 0;
			foreach ($this->regsSelectedArray as $reg) {
	            $reg = Player::find($reg);
	            if (!$reg->retired) {
	            	$counter++;
	                $reg->team_id = $this->teamTransfer;
	                $reg->save();
	            }
			}
			if ($counter > 0) {
	            if ($this->teamTransfer) {
					session()->flash('success', 'Registros seleccionados transferidos correctamente!.');
	            } else {
	            	session()->flash('success', 'Registros seleccionados convertidos en Free Agents correctamente!.');
	            }
			} else {
				session()->flash('error', 'Los registros que querías transferir son jugadores retirados.');
			}
			$this->emit('closeTransferModal');

			$this->teamTransfer = null;
		} else {
            $reg = Player::find(reset($this->regsSelectedArray));
            $reg->team_id = $this->teamTransfer;
            $reg->save();
            if ($this->teamTransfer) {
            	session()->flash('success', $reg->name . ' transferido a ' .$reg->team->name . ' correctamente!.');
            } else {
            	session()->flash('success', $reg->name . ' convertido en Free Agent correctamente!.');
            }

			$this->emit('closeTransferModal');

			$this->teamTransfer = null;
		}
    }

    public function retire($id, $retired)
    {
    	$reg = Player::find($id);
    	if ($retired) {
    		$reg->retired = 1;
    		$reg->team_id = null;
    	} else {
    		$reg->retired = 0;
    	}
    	$reg->save();

    	session()->flash('success', 'Registro actualizado correctamente.');
    }

    public function setNextPage()
    {
    	$this->page++;
    }

    public function setPreviousPage()
    {
		$this->page--;
    }

    public function render()
    {
    	// Load Session Preferences
    	$this->getSessionPreferences();

    	// Load Session Filters
    	if ($this->firstRender) {
    		$this->getSessionFilters();
    		$this->firstRender = false;
    	}
    	$this->setSessionFilters();

    	$teams = Team::orderBy('name', 'asc')->get();
    	$nations = Player::select('nation_name')->distinct()->whereNotNull('nation_name')->orderBy('nation_name', 'asc')->get();
    	$colleges = Player::select('college')->distinct()->whereNotNull('college')->orderBy('college', 'asc')->get();

        return view('livewire.admin.players', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'teams' => $teams,
        			'nations' => $nations,
        			'colleges' => $colleges,
        			'filterTeamName' => $this->filterTeamName(),
        			'filterRetiredName' => $this->filterRetiredName()
        		])->layout('adminlte::page');
    }

	protected function getData()
	{
		\DB::enableQueryLog();

    	$regs = Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
    		->name($this->search)
			->team($this->filterTeam)
			->position($this->filterPosition)
			->height($this->filterHeight)
			->weight($this->filterWeight)
			->college($this->filterCollege)
			->nation($this->filterNation)
			->age($this->filterAge)
			->yearDraft($this->filterYearDraft)
			->retired($this->filterRetired)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('players.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

		// dd(\DB::getQueryLog());

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
    		->name($this->search)
    		->team($this->filterTeam)
			->position($this->filterPosition)
			->height($this->filterHeight)
			->weight($this->filterWeight)
			->college($this->filterCollege)
			->nation($this->filterNation)
			->age($this->filterAge)
			->yearDraft($this->filterYearDraft)
			->retired($this->filterRetired)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('players.name', 'asc')
			->paginate($this->perPage)->onEachSide(2);

			// dd($regs);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
    		->name($this->search)
    		->team($this->filterTeam)
			->position($this->filterPosition)
			->height($this->filterHeight)
			->weight($this->filterWeight)
			->college($this->filterCollege)
			->nation($this->filterNation)
			->age($this->filterAge)
			->yearDraft($this->filterYearDraft)
			->retired($this->filterRetired)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('players.name', 'asc')
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
		return Player::
    		leftJoin('teams', 'teams.id', 'players.team_id')
    		->select('players.*', 'teams.name as team_name')
			->whereIn('players.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('players.name', 'asc')
			->get();
	}

	protected function filterTeamName()
	{
		if ($this->filterTeam != "all") {
			if ($this->filterTeam != "free_agents") {
				return Team::find($this->filterTeam)->name;
			} else {
				return "Free Agents";
			}
		}
	}
	protected function filterRetiredName()
	{
		if ($this->filterRetired != null) {
			return $this->filterRetired == 1 ? 'retirados' : 'en activo';
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
                'field'     => 'players.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'players.name',
                'direction' => 'desc'
            ],
            'team' => [
                'field'     => 'teams.name',
                'direction' => 'asc'
            ],
            'team_desc' => [
                'field'     => 'teams.name',
                'direction' => 'desc'
            ],
            'position' => [
                'field'     => 'position',
                'direction' => 'asc'
            ],
            'position_desc' => [
                'field'     => 'position',
                'direction' => 'desc'
            ],
            'nation_name' => [
                'field'     => 'nation_name',
                'direction' => 'asc'
            ],
            'nation_name_desc' => [
                'field'     => 'nation_name',
                'direction' => 'desc'
            ],
            'birthdate' => [
                'field'     => 'birthdate',
                'direction' => 'asc'
            ],
            'birthdate_desc' => [
                'field'     => 'birthdate',
                'direction' => 'desc'
            ],
            'height' => [
                'field'     => 'height',
                'direction' => 'asc'
            ],
            'height_desc' => [
                'field'     => 'height',
                'direction' => 'desc'
            ],
            'weight' => [
                'field'     => 'weight',
                'direction' => 'asc'
            ],
            'weight_desc' => [
                'field'     => 'weight',
                'direction' => 'desc'
            ],
            'draft_year' => [
                'field'     => 'draft_year',
                'direction' => 'asc'
            ],
            'draft_year_desc' => [
                'field'     => 'draft_year',
                'direction' => 'desc'
            ],
            'college' => [
                'field'     => 'college',
                'direction' => 'asc'
            ],
            'college_desc' => [
                'field'     => 'college',
                'direction' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}