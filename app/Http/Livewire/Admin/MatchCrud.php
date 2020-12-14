<?php

namespace App\Http\Livewire\Admin;

use App\Models\Match;
use App\Models\Score;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithFileUploads;
use App\Exports\MatchesExport;
use App\Imports\MatchesImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Events\TableWasUpdated;

class MatchCrud extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $firstRender = true;

	//model info
	public $modelSingular = "partido";
	public $modelPlural = "partidos";
	public $modelGender = "male";
	public $modelHasImg = false;

	//fields
	public $season;
	public $reg_id, $season_id, $local_team_id, $local_manager_id, $visitor_team_id, $visitor_manager_id, $stadium;
	//boxscore
	public $scores;

	//filters
	public $search = "";
	public $perPage = '10';
	public $filterTeam = "all";
	public $filterUser = "all";
	public $order = 'id_desc';

	// preferences vars
	public $showTableImages;
	public $striped;
	public $fixedFirstColumn;
	public $colScores;
	public $colLocalManager;
	public $colVisitorManager;
	public $colStadium;

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
		'filterTeam' => ['except' => "all"],
		'filterUser' => ['except' => "all"],
		'perPage' => ['except' => '10'],
		'order' => ['except' => 'id_desc'],
	];

	// Session Preferences
	public function setSessionPreferences()
	{
		session([
			'matches.fixedFirstColumn' => $this->fixedFirstColumn ? 'on' : 'off',
			'matches.showTableImages' => $this->showTableImages ? 'on' : 'off',
			'matches.striped' => $this->striped ? 'on' : 'off',
			'matches.colScores' => $this->colScores ? 'on' : 'off',
			'matches.colLocalManager' => $this->colLocalManager ? 'on' : 'off',
			'matches.colVisitorManager' => $this->colVisitorManager ? 'on' : 'off',
			'matches.colStadium' => $this->colStadium ? 'on' : 'off',
		]);

		if (!$this->colScores && !$this->colLocalManager && !$this->colVisitorManager && !$this->colStadium) {
			session(['matches.fixedFirstColumn' => 'off']);
		}
	}

	protected function getSessionPreferences()
	{
		if (session()->get('matches.showTableImages')) {
			$this->showTableImages = session()->get('matches.showTableImages') == 'on' ? true : false;
		} else {
			$this->showTableImages = true;
		}
		if (session()->get('matches.fixedFirstColumn')) {
			$this->fixedFirstColumn = session()->get('matches.fixedFirstColumn') == 'on' ? true : false;
		} else {
			$this->fixedFirstColumn = true;
		}
		if (session()->get('matches.striped')) {
			$this->striped = session()->get('matches.striped') == 'on' ? true : false;
		} else {
			$this->striped = true;
		}
		if (session()->get('matches.colScores')) {
			$this->colScores = session()->get('matches.colScores') == 'on' ? true : false;
		} else {
			$this->colScores = true;
		}
		if (session()->get('matches.colLocalManager')) {
			$this->colLocalManager = session()->get('matches.colLocalManager') == 'on' ? true : false;
		} else {
			$this->colLocalManager = true;
		}
		if (session()->get('matches.colVisitorManager')) {
			$this->colVisitorManager = session()->get('matches.colVisitorManager') == 'on' ? true : false;
		} else {
			$this->colVisitorManager = true;
		}
		if (session()->get('matches.colStadium')) {
			$this->colStadium = session()->get('matches.colStadium') == 'on' ? true : false;
		} else {
			$this->colStadium = true;
		}
	}

	// Session State
	protected function setSessionState()
	{
		session([
			//fields
			'matches.reg_id' => $this->reg_id,
			'matches.season_id' => $this->season_id,
			'matches.local_team_id' => $this->local_team_id,
			'matches.local_manager_id' => $this->local_manager_id,
			'matches.visitor_team_id' => $this->visitor_team_id,
			'matches.visitor_manager_id' => $this->visitor_manager_id,
			'matches.stadium' => $this->stadium,
			//filters
			'matches.search' => $this->search,
			'matches.perPage' => $this->perPage,
			'matches.filterTeam' => $this->filterTeam,
			'matches.filterUser' => $this->filterUser,
			'matches.order' => $this->order,
			'matches.page' => $this->page,
			'matches.regsSelectedArray' => $this->regsSelectedArray,
			// general vars
			'matches.currentModal' => $this->currentModal,
			'matches.editMode' => $this->editMode,
			'matches.continuousInsert' => $this->continuousInsert,
			//selected regs
			'matches.regsSelectedArray' => $this->regsSelectedArray,
			'matches.checkAllSelector' => $this->checkAllSelector,
		]);
	}

	protected function getSessionState()
	{
		//fields
		if (session()->get('matches.reg_id')) { $this->reg_id = session()->get('matches.reg_id'); }
		if (session()->get('matches.season_id')) { $this->season_id = session()->get('matches.season_id'); }
		if (session()->get('matches.local_team_id')) { $this->local_team_id = session()->get('matches.local_team_id'); }
		if (session()->get('matches.local_manager_id')) { $this->local_manager_id = session()->get('matches.local_manager_id'); }
		if (session()->get('matches.visitor_team_id')) { $this->visitor_team_id = session()->get('matches.visitor_team_id'); }
		if (session()->get('matches.visitor_manager_id')) { $this->visitor_manager_id = session()->get('matches.visitor_manager_id'); }
		if (session()->get('matches.stadium')) { $this->stadium = session()->get('matches.stadium'); }
		//filters
		if (session()->get('matches.search')) { $this->search = session()->get('matches.search'); }
		if (session()->get('matches.perPage')) { $this->perPage = session()->get('matches.perPage'); }
		if (session()->get('matches.filterTeam')) { $this->filterTeam = session()->get('matches.filterTeam'); }
		if (session()->get('matches.filterUser')) { $this->filterUser = session()->get('matches.filterUser'); }
		if (session()->get('matches.order')) { $this->order = session()->get('matches.order'); }
		if (session()->get('matches.page')) { $this->page = session()->get('matches.page'); }
		if (session()->get('matches.regsSelectedArray')) { $this->regsSelectedArray = session()->get('matches.regsSelectedArray'); }
		// general vars
		if (session()->get('matches.currentModal')) { $this->currentModal = session()->get('matches.currentModal'); }
		if (session()->get('matches.editMode')) { $this->editMode = session()->get('matches.editMode'); }
		if (session()->get('matches.continuousInsert')) { $this->continuousInsert = session()->get('matches.continuousInsert'); }
		//selected regs
		if (session()->get('matches.regsSelectedArray')) { $this->regsSelectedArray = session()->get('matches.regsSelectedArray'); }
		if (session()->get('matches.checkAllSelector')) { $this->checkAllSelector = session()->get('matches.checkAllSelector'); }
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
    	$regs = Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
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

    public function cancelFilterTeam()
    {
		$this->filterTeam = "all";
    }

    public function cancelFilterUser()
    {
		$this->filterUser = "all";
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
		$this->filterTeam = "all";
		$this->filterUser = "all";

		$this->emit('resetFiltersMode');
    }

    // Add & Store
    protected function resetFields()
    {
		$this->season_id = $this->season->id;
    	$firstTeam = SeasonTeam::leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    	->select('seasons_teams.*')
    	->where('season_id', $this->season->id)
    	->orderBy('teams.medium_name', 'asc')
    	->first()->id;
		$this->local_team_id = $firstTeam;
		$this->local_manager_id = null;
		$this->visitor_team_id = $firstTeam;
		$this->visitor_manager_id = null;
		$this->stadium = null;
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
            'local_team_id' => 'different:visitor_team_id',
            'visitor_team_id' => 'different:local_team_id',
        ],
	    [
	    	'local_team_id.different' => 'Los equipos deben ser diferentes',
	    	'visitor_team_id.different' => 'Los equipos deben ser diferentes',
        ]);

		$validatedData['season_id'] = $this->season_id;
		$local_team = SeasonTeam::find($this->local_team_id);
		$validatedData['local_manager_id'] = $local_team->team->manager_id;
		$validatedData['stadium'] = $local_team->team->stadium;
		$visitor_team = SeasonTeam::find($this->visitor_team_id);
		$validatedData['visitor_manager_id'] = $visitor_team->team->manager_id;

        $reg = Match::create($validatedData);

        // create scores
        // previously create season_score_headers

        event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT)));
        session()->flash('success', 'Registro agregado correctamente.');

		if ($this->continuousInsert) {
			$this->resetFields();
			$this->resetValidation();
		} else {
			$this->resetFields();
			$this->emit('closeAddModal');
			$this->closeAnyModal();
		}
    }

    public function exchangeTeams()
    {
    	$local = $this->local_team_id;
    	$visitor = $this->visitor_team_id;

    	$this->local_team_id = $visitor;
    	$this->visitor_team_id = $local;
    }

	// Edit & Update
    public function edit($id)
    {
    	$this->resetFields();
		$this->resetValidation();

    	$reg = Match::find($id);
		$this->reg_id = $reg->id;
    	$this->season_id = $reg->season_id;
    	$this->local_team_id = $reg->local_team_id;
    	$this->local_manager_id = $reg->local_manager_id;
    	$this->visitor_team_id = $reg->visitor_team_id;
    	$this->visitor_manager_id = $reg->visitor_manager_id;
		$this->stadium = $reg->stadium;

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = Match::find($this->reg_id);
    	$before = $reg->toJson(JSON_PRETTY_PRINT);

        $validatedData = $this->validate([
            'local_team_id' => 'different:visitor_team_id',
            'visitor_team_id' => 'different:local_team_id',
        ],
	    [
	    	'local_team_id.different' => 'Los equipos deben ser diferentes',
	    	'visitor_team_id.different' => 'Los equipos deben ser diferentes',
        ]);

		$validatedData['season_id'] = $this->season_id;
		$local_team = SeasonTeam::find($this->local_team_id);
		$validatedData['local_manager_id'] = $local_team->team->manager_id;
		$validatedData['stadium'] = $local_team->team->stadium;
		$visitor_team = SeasonTeam::find($this->visitor_team_id);
		$validatedData['visitor_manager_id'] = $visitor_team->team->manager_id;

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
			if ($reg = Match::find($reg)) {
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
    	$this->regView = Match::find($id);
    	$this->emit('openViewModal');
    }

    // View
    public function boxscore($id)
    {
    	$this->regView = Match::find($id);
    	$this->emit('openBoxscoreModal');
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
	            if ($original = Match::find($reg)) {
	            	$counter++;
	                $reg = $original->replicate();
	                $reg->save();
	                //replicate scores
	            	event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro duplicado'));
	            }
			}
			if ($counter > 0) {
				session()->flash('success', 'Registros seleccionados duplicados correctamente!.');
			} else {
				session()->flash('error', 'Los registros que querías duplicar ya no existen.');
			}
		} elseif (count($this->regsSelectedArray) == 1) {
            if ($original = Match::find(reset($this->regsSelectedArray))) {
                $reg = $original->replicate();
                $reg->save();
                //replicate scores
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

    	$filename = $this->filenameExportTable ?: 'divisiones';

    	$regs = Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
    		->get();

		$regs->makeHidden(['created_at', 'updated_at']);

		session()->flash('success', 'Registros exportados correctamente!.');
    	return Excel::download(new MatchesExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmExportSelected($format)
    {
    	$this->formatExport = $format;
		$this->emit('openExportSelectedModal');
    }

    public function selectedExport()
    {
    	$this->emit('closeExportSelectedModal');

    	$filename = $this->filenameExportSelected ?: 'divisiones_seleccionadas';

    	$regs = Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
    		->whereIn('matches.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
        	->get();
        $regs->makeHidden(['created_at', 'updated_at']);

        session()->flash('success', 'Registros exportados correctamente!.');
		return Excel::download(new MatchesExport($regs), $filename . '.' . $this->formatExport);
    }

    public function confirmImport()
    {
    	$this->fileImport = null;
		$this->emit('openImportModal');
    }

    public function import()
    {
        if ($this->fileImport != null) {
        	Excel::import(new MatchesImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
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


    // Mount & Render
    public function mount(Season $season)
    {
        $this->season = $season;
    	$this->scores = Collection::make();
		foreach ($this->season->scores_headers as $header) {
			$h['seasons_scores_headers_id'] = $header->id;
			$h['seasons_scores_headers_name'] = $header->scoreHeader->name;
			$h['local_score'] = null;
			$h['visitor_score'] = null;
			$this->scores->push($h);
		}
    }

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

    	$seasons = Season::orderBy('id', 'desc')->get();
    	$season_teams = SeasonTeam::leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    	->select('seasons_teams.*')
    	->where('season_id', $this->season->id)
    	->orderBy('teams.medium_name', 'asc')
    	->get();
    	$managers = SeasonTeam::leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    	->leftJoin('users', 'users.id', 'teams.manager_id')
    	->where('season_id', $this->season->id)
    	->whereNotNull('teams.manager_id')
    	->select('users.*')
    	->distinct()
    	->orderBy('users.name', 'asc')
    	->get();

        return view('admin.matches', [
        			'regs' => $this->getData(),
        			'regsSelected' => $this->getDataSelected(),
        			'seasons' => $seasons,
        			'season_teams' => $season_teams,
        			'managers' => $managers,
        			'filterTeamName' => $this->filterTeamName(),
        			'filterUserName' => $this->filterUserName(),
        			'firstRenderSaved' => $firstRenderSaved,
        			'currentModal' => $this->currentModal,
        			'scores' => $this->scores
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
			->paginate($this->perPage)->onEachSide(2);


        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
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
		return Match::
   			leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
			->whereIn('matches.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->select('matches.*')
			->groupBy('matches.id')
			->get();
	}

	protected function filterTeamName()
	{
		if ($this->filterTeam != "all") {
			if ($var = SeasonTeam::find($this->filterTeam)) {
				return $var->team->name;
			} else {
				$this->filterTeam = "all";
			}
		}
	}
	protected function filterUserName()
	{
		if ($this->filterUser != "all") {
			if ($var = User::find($this->filterUser)) {
				return $var->name;
			} else {
				$this->filterUser = "all";
			}
		}
	}

    protected function getOrder($order) {
        $order_ext = [
            'id' => [
                'field'     => 'matches.id',
                'direction' => 'asc'
            ],
            'id_desc' => [
                'field'     => 'matches.id',
                'direction' => 'desc'
            ],
            'stadium' => [
                'field'     => 'matches.stadium',
                'direction' => 'asc'
            ],
            'stadium_desc' => [
                'field'     => 'matches.stadium',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

	public function setCurrentModal($modal)
	{
		$this->currentModal = $modal;
		session([
			'matches.currentModal' => $this->currentModal,
		]);
	}

	public function closeAnyModal()
	{
		$this->currentModal = '';
	}

	public function storeResult()
	{
		foreach ($this->scores as $key => $score_temp) {
			$score = Score::create([
				'match_id' => $this->regView->id,
				'seasons_scores_headers_id' => $score_temp['seasons_scores_headers_id'],
				'local_score' => $score_temp['local_score'],
				'visitor_score' => $score_temp['visitor_score'],
				'order' => $key+1,
			]);
		}
	}
}