<?php

namespace App\Http\Livewire\Admin;

use App\Models\Season;
use App\Models\Team;
use App\Models\SeasonTeam;
use App\Models\SeasonDivision;
use App\Models\SeasonConference;
use App\Models\ScoreHeader;
use App\Models\SeasonScoreHeader;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\SeasonsExport;
use App\Imports\SeasonsImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Events\TableWasUpdated;

class SeasonCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "temporada";
	public $modelPlural = "temporadas";
	public $modelGender = "female";
	public $modelHasImg = false;

	//fields
	public $reg_id, $name, $current;

	//filters
	public $search = "";
	public $perPage = '10';
	public $order = 'id_desc';

	// preferences vars
	public $striped;

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
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'seasons.striped' => $this->striped ? 'on' : 'off',
		]);
	}

	protected function getSessionPreferences()
	{
		if (session()->get('seasons.striped')) {
			$this->striped = session()->get('seasons.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'seasons.reg_id' => $this->reg_id,
			'seasons.name' => $this->name,
			'seasons.current' => $this->current,
			//filters
			'seasons.search' => $this->search,
			'seasons.perPage' => $this->perPage,
			'seasons.order' => $this->order,
			'seasons.page' => $this->page,
			'seasons.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'seasons.currentModal' => $this->currentModal,
			'seasons.editMode' => $this->editMode,
			'seasons.continuousInsert' => $this->continuousInsert,
			//selected regs
			'seasons.regsSelectedArray' => $this->regsSelectedArray,
			'seasons.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('seasons.reg_id')) { $this->reg_id = session()->get('seasons.reg_id'); }
		if (session()->get('seasons.name')) { $this->name = session()->get('seasons.name'); }
		if (session()->get('seasons.current')) { $this->current = session()->get('seasons.current'); }
		//filters
		if (session()->get('seasons.search')) { $this->search = session()->get('seasons.search'); }
		if (session()->get('seasons.perPage')) { $this->perPage = session()->get('seasons.perPage'); }
		if (session()->get('seasons.order')) { $this->order = session()->get('seasons.order'); }
		if (session()->get('seasons.page')) { $this->page = session()->get('seasons.page'); }
		if (session()->get('seasons.regsSelectedArray')) { $this->regsSelectedArray = session()->get('seasons.regsSelectedArray'); }
		// general vars
		if (session()->get('seasons.currentModal')) { $this->currentModal = session()->get('seasons.currentModal'); }
		if (session()->get('seasons.editMode')) { $this->editMode = session()->get('seasons.editMode'); }
		if (session()->get('seasons.continuousInsert')) { $this->continuousInsert = session()->get('seasons.continuousInsert'); }
		//selected regs
		if (session()->get('seasons.regsSelectedArray')) { $this->regsSelectedArray = session()->get('seasons.regsSelectedArray'); }
		if (session()->get('seasons.checkAllSelector')) { $this->checkAllSelector = session()->get('seasons.checkAllSelector'); }
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
    	$regs = Season::
			select('seasons.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);
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

    public function cancelFilterConference()
    {
		$this->filterConference = "all";
    }

    public function cancelFilterActive()
    {
		$this->filterActive = "all";
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

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->name = null;
		$this->img = null;
		$this->current = 0;
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
        $validatedData = $this->validate([
            'name' => 'required|unique:seasons,name',
        ],
	    [
	    	'name.required' => 'El nombre es obligatorio',
	    	'name.unique' => 'El existe un registro con el mismo nombre',
        ]);

        if ($this->existsCurrent()) {
        	if ($this->current) {
        		$this->desactiveCurrent();
        		$validatedData['current'] = 1;
        	} else {
        		$validatedData['current'] = 0;
        	}
        } else {
        	$validatedData['current'] = 1;
        }
        $validatedData['slug'] = Str::slug($this->name, '-');

        $reg = Season::create($validatedData);
        //auto-generate actived teams with their divions and conferences
        $this->generateSeasonDependencies($reg);

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

    protected function generateSeasonDependencies($reg)
    {
        $actived_teams = Team::where('active', 1)->get();
        foreach ($actived_teams as $team) {
        	$season_conferences = SeasonConference::where('season_id', $reg->id)->where('conference_id', $team->division->conference->id)->count();
        	if ($season_conferences == 0) {
	        	$seasonConference = SeasonConference::create([
	        		'season_id' => $reg->id,
	        		'conference_id' => $team->division->conference->id
	        	]);
        		event(new TableWasUpdated($seasonConference, 'insert', $seasonConference->toJson(JSON_PRETTY_PRINT)));
        	}

        	$season_divisions = SeasonDivision::where('season_id', $reg->id)->where('division_id', $team->division->id)->count();
        	if ($season_divisions == 0) {
	        	$seasonDivision = SeasonDivision::create([
	        		'season_id' => $reg->id,
	        		'division_id' => $team->division->id,
                    'season_conference_id' => SeasonConference::where('season_id', $reg->id)->where('conference_id', $team->division->conference_id)->first()->id,
	        	]);
        		event(new TableWasUpdated($seasonDivision, 'insert', $seasonDivision->toJson(JSON_PRETTY_PRINT)));
        	}

        	$seasonTeam = SeasonTeam::create([
        		'season_id' => $reg->id,
        		'team_id' => $team->id,
                'season_division_id' => SeasonDivision::where('season_id', $reg->id)->where('division_id', $team->division_id)->first()->id,
        	]);
        	event(new TableWasUpdated($seasonTeam, 'insert', $seasonTeam->toJson(JSON_PRETTY_PRINT)));
        }

    	$active_scores_headers = ScoreHeader::where('active', 1)->orderBy('order')->get();
        foreach ($active_scores_headers as $score) {
        	$scoreHeader = SeasonScoreHeader::create([
        		'season_id' => $reg->id,
        		'score_header_id' => $score->id
        	]);
        	event(new TableWasUpdated($scoreHeader, 'insert', $scoreHeader->toJson(JSON_PRETTY_PRINT)));
        }
    }

	// Edit & Update
    public function edit($id)
    {
    	$this->resetFields();
		$this->resetValidation();

    	$reg = Season::find($id);
		$this->reg_id = $reg->id;
    	$this->name = $reg->name;
		$this->current = $reg->current;

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Season::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        $validatedData = $this->validate([
            'name' => 'required|unique:seasons,name,' . $reg->id,
        ],
	    [
	    	'name.required' => 'El nombre es obligatorio',
	    	'name.unique' => 'El existe un registro con el mismo nombre',
        ]);

        if ($this->existsCurrent()) {
        	if ($this->current) {
				if ($this->getCurrent() != $reg->id) {
        			$this->desactiveCurrent();
				}
        		$validatedData['current'] = 1;
        	} else {
        		$validatedData['current'] = 0;
        	}
        } else {
        	$validatedData['current'] = 1;
        }
        $validatedData['slug'] = Str::slug($this->name, '-');

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
			if ($reg = Season::find($reg)) {
				if ($reg->canDestroy()) {
					event(new TableWasUpdated($reg, 'delete'));
					if ($reg->delete()) {
						$regs_deleted++;
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
    	$this->regView = Season::find($id);
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

    	$filename = $this->filenameExportTable ?: 'temporadas';

    	$regs = Season::
			select('seasons.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
    		->get();

		$regs->makeHidden(['slug', 'created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new SeasonsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'temporadas_seleccionadas';

    	$regs = Season::
			select('seasons.*')
    		->whereIn('seasons.id', $this->regsSelectedArray)
        	->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
        	->get();
        $regs->makeHidden(['slug', 'created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new SeasonsExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new SeasonsImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		session()->flash('success', 'Registros importados correctamente!.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
    }

	// Update fields
    public function current($id)
    {
    	$this->desactiveCurrent();

    	$reg = Season::find($id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);
    	$reg->current = 1;
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

    	$regs = $this->getData();
    	if ($regs->count() > 0 && !$this->existsCurrent()) {
    		$this->setLastCurrent();
    	}

        return view('admin.seasons', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Season::
			select('seasons.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Season::
			select('seasons.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Season::
			select('seasons.*')
    		->name($this->search)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->paginate($this->perPage, ['*'], 'page', $this->page);

		$this->checkAllSelector = 1;
		foreach ($regs as $Conference) {
			$array_id = array_search($Conference->id, $this->regsSelectedArray);
			if (!$array_id) {
				$this->checkAllSelector = 0;
			}
		}
	}

	protected function getDataSelected()
	{
		return Season::
			select('seasons.*')
			->whereIn('seasons.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
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
            'name' => [
                'field'     => 'seasons.name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'seasons.name',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

    protected function desactiveCurrent()
    {
    	$regs = Season::where('current', true)->get();
    	if ($regs->count() > 0) {
    		foreach ($regs as $reg) {
		    	$before = $reg->toJson(JSON_PRETTY_PRINT);
		    	$reg->current = 0;
		    	$reg->save();
		    	event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));
    		}
    	}
    }

    protected function existsCurrent()
    {
    	return Season::where('current', true)->count() > 0 ? true : false;
    }

    protected function getCurrent()
    {
    	return Season::where('current', true)->first()->id;
    }

   protected function setLastCurrent()
    {
    	$reg = Season::orderBy('id', 'desc')->first();
    	$before = $reg->toJson(JSON_PRETTY_PRINT);
    	$reg->current = 1;
    	$reg->save();
    	event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));

		session()->flash('info', 'Se ha asignado automáticamente el último registro como temporada activa al no detectarse temporada activa.');
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'seasons.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}
}