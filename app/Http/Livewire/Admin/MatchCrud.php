<?php

namespace App\Http\Livewire\Admin;

use App\Models\MatchModel;
use App\Models\MatchPoll;
use App\Models\Score;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\TeamStat;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\MatchesExport;
use App\Imports\MatchesImport;
use App\Imports\MatchesScoresImport;
use App\Imports\MatchesTeamStatsImport;
use App\Imports\MatchesPlayerStatsImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Traits\PostTrait;

use App\Events\TableWasUpdated;
use App\Events\PostStored;

class MatchCrud extends Component
{
	use WithPagination;
	use WithFileUploads;
	use PostTrait;

	public $firstRender = true;

	//model info
	public $modelSingular = "partido";
	public $modelPlural = "partidos";
	public $modelGender = "male";
	public $modelHasImg = false;

	//fields
	public $season;
	public $reg_id, $season_id, $local_team_id, $local_manager_id, $visitor_team_id, $visitor_manager_id, $stadium, $extra_times;
	//boxscore
	public $scores, $players_stats, $teams_stats, $update_match_managers;
	public $total_scores = [];

	//filters
	public $search = "";
	public $perPage = '25';
	public $filterTeam = "all";
	public $filterUser = "all";
	public $filterPlayed = "all";
	public $filterReport = "all";
	public $order = 'id_desc';

	// preferences vars
	public $showTableImages;
	public $striped;
	public $fixedFirstColumn;
	public $colScores;
	public $colLocalManager;
	public $colVisitorManager;
	public $colStadium;
	public $colPlayedData;

	// general vars
	public $currentModal;
	public $editMode = false;
	public $editBoxscoreMode = false;
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

	public function checkMatchesState() {
		$regs = MatchModel::all();
		foreach ($regs as $reg) {
			$match = MatchModel::find($reg->id);
			$match->played = $reg->played() ? 1 : 0;
			$match->teamStats_state = $reg->checkTeamStats();
			$match->playerStats_state = $reg->checkPlayerStats();
			$match->save();
		}
		session()->flash('success', 'Partidos chequeados correctamente.');
	}


	// queryString
	protected $queryString = [
		'search' => ['except' => ''],
		'filterTeam' => ['except' => "all"],
		'filterUser' => ['except' => "all"],
		'filterPlayed' => ['except' => "all"],
		'filterReport' => ['except' => "all"],
		'perPage' => ['except' => '25'],
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
			'matches.colPlayedData' => $this->colPlayedData ? 'on' : 'off',
		]);

		if (!$this->colScores && !$this->colLocalManager && !$this->colVisitorManager && !$this->colStadium && !$this->colPlayedData) {
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
		if (session()->get('matches.colPlayedData')) {
			$this->colPlayedData = session()->get('matches.colPlayedData') == 'on' ? true : false;
		} else {
			$this->colPlayedData = true;
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
			'matches.extra_times' => $this->extra_times,
			//filters
			'matches.search' => $this->search,
			'matches.perPage' => $this->perPage,
			'matches.filterTeam' => $this->filterTeam,
			'matches.filterUser' => $this->filterUser,
			'matches.filterPlayed' => $this->filterPlayed,
			'matches.filterReport' => $this->filterReport,
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
		if (session()->get('matches.extra_times')) { $this->extra_times = session()->get('matches.extra_times'); }
		//filters
		if (session()->get('matches.search')) { $this->search = session()->get('matches.search'); }
		if (session()->get('matches.perPage')) { $this->perPage = session()->get('matches.perPage'); }
		if (session()->get('matches.filterTeam')) { $this->filterTeam = session()->get('matches.filterTeam'); }
		if (session()->get('matches.filterUser')) { $this->filterUser = session()->get('matches.filterUser'); }
		if (session()->get('matches.filterPlayed')) { $this->filterPlayed = session()->get('matches.filterPlayed'); }
		if (session()->get('matches.filterReport')) { $this->filterReport = session()->get('matches.filterReport'); }
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
    	$regs = MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
    		->played($this->filterPlayed)
    		->report($this->filterReport)
    		->where('matches.season_id', $this->season->id)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
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

    public function cancelFilterPlayed()
    {
		$this->filterPlayed = "all";
    }

    public function cancelFilterReport()
    {
		$this->filterReport = "all";
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
		$this->filterTeam = "all";
		$this->filterUser = "all";
		$this->filterPlayed = "all";
		$this->filterReport = "all";

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
		$this->extra_times = null;
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
		$validatedData['played'] = 0;
		$validatedData['teamStats_state'] = 'error';
		$validatedData['playerStats_state'] = 'error';

        $reg = MatchModel::create($validatedData);

        // create match_poll

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

    	$reg = MatchModel::find($id);
		$this->reg_id = $reg->id;
    	$this->season_id = $reg->season_id;
    	$this->local_team_id = $reg->local_team_id;
    	$this->local_manager_id = $reg->local_manager_id;
    	$this->visitor_team_id = $reg->visitor_team_id;
    	$this->visitor_manager_id = $reg->visitor_manager_id;
		$this->stadium = $reg->stadium;
		$this->extra_times = $reg->extra_times;

    	$this->emit('openEditModal');
    	$this->setCurrentModal('editModal');

    	$this->editMode = true;
    }

    public function update()
    {
    	$reg = MatchModel::find($this->reg_id);
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
			if ($reg = MatchModel::find($reg)) {
				if ($reg->canDestroy()) {
					//restore injuries
					foreach ($reg->playerStats as $player_stat) {
						if ($player_stat->injury_id > 0) {
							$player = Player::find($player_stat->player_id);
							$before = $player->toJson(JSON_PRETTY_PRINT);

							$player->injury_id = $player_stat->injury_id;
							$player->injury_matches = $player_stat->injury_matches;
							$player->injury_days = $player_stat->injury_days;
							$player->injury_playable = $player_stat->injury_playable;

							$player->save();
							event(new TableWasUpdated($player, 'update', $player->toJson(JSON_PRETTY_PRINT), $before));
						}
					}
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
    	$this->regView = MatchModel::find($id);
    	$this->emit('openViewModal');
    }

    // View
    public function boxscore($id)
    {
    	$this->regView = MatchModel::find($id);

    	if ($this->regView->scores->count() > 0 || $this->regView->teamStats->count() > 0 || $this->regView->playerStats->count() > 0) {
    		$this->update_match_managers = false;
    		if ($this->regView->scores->count() > 0) {
    			$this->loadScores();
    		} else {
    			$this->initializeScores();
    		}
    		if ($this->regView->playerStats->count() > 0) {
    			$this->loadPlayerStats();
    		} else {
    			$this->initializePlayerStats();
    		}
    		if ($this->regView->teamStats->count() > 0) {
    			$this->loadTeamStats();
    		} else {
    			$this->initializeTeamStats();
    		}
			$this->editBoxscoreMode = true;

    	} else {
    		$this->update_match_managers = false;
    		$this->initializeScores();
    		$this->initializePlayerStats();
    		$this->initializeTeamStats();
			$this->editBoxscoreMode = false;
    	}

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
	            if ($original = MatchModel::find($reg)) {
	            	$counter++;
	                $reg = $original->replicate();
	                //set current managers
	                $reg->local_manager_id = $original->localTeam->team->manager_id;
	                $reg->visitor_manager_id = $original->visitorTeam->team->manager_id;
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
            if ($original = MatchModel::find(reset($this->regsSelectedArray))) {
                $reg = $original->replicate();
                //set current managers
                $reg->local_manager_id = $original->localTeam->team->manager_id;
                $reg->visitor_manager_id = $original->visitorTeam->team->manager_id;
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

    	$filename = $this->filenameExportTable ?: 'partidos';

    	$regs = MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
    		->played($this->filterPlayed)
    		->report($this->filterReport)
    		->where('matches.season_id', $this->season->id)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
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

    	$filename = $this->filenameExportSelected ?: 'partidos_seleccionados';

    	$regs = MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
			->whereIn('matches.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
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
    		session()->flash('success', 'Proceso de importación de datos finalizado.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportModal');
    }

    public function confirmCheckMatches()
    {
		$this->emit('openCheckMatchesModal');
    }

    public function checkMatches()
    {
    	$matches = MatchModel::with('localTeam.team')->with('visitorTeam.team')->where('matches.season_id', $this->season->id)->get();
    	$counter = 0;
    	foreach ($matches as $match) {
    		if (!$match->played()) {
    			$before = $match->toJson(JSON_PRETTY_PRINT);
				// $local_team = SeasonTeam::find($match->local_team_id);
				// $visitor_team = SeasonTeam::find($match->visitor_team_id);

				$validatedData['local_manager_id'] = $match->localTeam->team->manager_id;
				$validatedData['visitor_manager_id'] = $match->visitorTeam->team->manager_id;
				$validatedData['stadium'] = $match->localTeam->team->stadium;

				$match->fill($validatedData);

		        if ($match->isDirty()) {
		            if ($match->update()) {
		            	event(new TableWasUpdated($match, 'update', $match->toJson(JSON_PRETTY_PRINT), $before));
						$counter++;
		            }
		        }
    		}
    	}

		if ($counter > 0) {
			session()->flash('success', 'Registros editados correctamente!.');
		} else {
			session()->flash('info', 'No se han detectado cambios en los registros.');
		}
    	$this->emit('closeCheckMatchesModal');
    }

    public function confirmImportScores()
    {
    	$this->fileImport = null;
		$this->emit('openImportScoresModal');
    }

    public function importScores()
    {
        if ($this->fileImport != null) {
        	Excel::import(new MatchesScoresImport, $this->fileImport);
        	// (new TeamsImport)->queue($this->fileImport);
    		session()->flash('success', 'Proceso de importación de datos finalizado.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportScoresModal');
    }

    public function confirmImportTeamStats()
    {
    	$this->fileImport = null;
		$this->emit('openImportTeamStatsModal');
    }

    public function importTeamStats()
    {
        if ($this->fileImport != null) {
        	Excel::import(new MatchesTeamStatsImport, $this->fileImport);
    		session()->flash('success', 'Proceso de importación de datos finalizado.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportTeamStatsModal');
    }

    public function confirmImportPlayerStats()
    {
    	$this->fileImport = null;
		$this->emit('openImportPlayerStatsModal');
    }

    public function importPlayerStats()
    {
        if ($this->fileImport != null) {
        	Excel::import(new MatchesPlayerStatsImport, $this->fileImport);
    		session()->flash('success', 'Proceso de importación de datos finalizado.');
        } else {
        	session()->flash('error', 'Ningún archivo seleccionado.');
        }
    	$this->emit('closeImportPlayerStatsModal');
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
    	$season_teams = SeasonTeam::
    	with('team')
    	->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    	->select('seasons_teams.*')
    	->where('season_id', $this->season->id)
    	->orderBy('teams.medium_name', 'asc')
    	->get();
    	$managers = SeasonTeam::
    	with('team')
    	->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    	->leftJoin('users', 'users.id', 'teams.manager_id')
    	->where('season_id', $this->season->id)
    	->whereNotNull('teams.manager_id')
    	->select('users.*')
    	->distinct()
    	->orderBy('users.name', 'asc')
    	->get();

    	$this->updateScores();

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
        			'scores' => $this->scores,
        			'total_scores' => $this->total_scores,
        		])->layout('adminlte::page');
    }

    // Helpers
	protected function getData()
	{
    	$regs = MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
    		->withCount('teamStats')
    		->withCount('playerStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
            ->leftJoin('players_stats', 'matches.id', 'players_stats.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
    		->played($this->filterPlayed)
    		->report($this->filterReport)
    		->where('matches.season_id', $this->season->id)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
    		->played($this->filterPlayed)
    		->report($this->filterReport)
    		->where('matches.season_id', $this->season->id)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
			->paginate($this->perPage)->onEachSide(2);

        $this->setCheckAllSelector();
		return $regs;
	}

	protected function setCheckAllSelector()
	{
    	$regs = MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
    		->name($this->search)
    		->team($this->filterTeam)
    		->user($this->filterUser)
    		->played($this->filterPlayed)
    		->report($this->filterReport)
    		->where('matches.season_id', $this->season->id)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
			->paginate($this->perPage)->onEachSide(2);

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
    	return MatchModel::
    		with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'teamStats')
   			->leftjoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftjoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->leftJoin('scores', 'matches.id', 'scores.match_id')
			->select('matches.*', 'scores.created_at AS disputed_at')
			->whereIn('matches.id', $this->regsSelectedArray)
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->distinct('matches.id')
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
            'playedData' => [
                'field'     => 'disputed_at',
                'direction' => 'asc'
            ],
            'playedData_desc' => [
                'field'     => 'disputed_at',
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

	protected function updateScores()
	{

        $total_local_scores = 0;
        $total_visitor_scores = 0;
        if ($this->scores != null) {
	        foreach ($this->scores as $score) {
				$local = $score['local_score'] == null ? 0 : $score['local_score'];
				$visitor = $score['visitor_score'] == null ? 0 : $score['visitor_score'];
				$total_local_scores += $local;
				$total_visitor_scores += $visitor;
	        }
        }
        $this->total_scores['local'] = $total_local_scores;
        $this->total_scores['visitor'] = $total_visitor_scores;
	}

	public function storeMatch()
	{
		$this->storeResult();
		$this->storePlayerStats();
		$this->storeTeamStats();

		//update local and visitor manager_id
		if ($this->update_match_managers) {
			$match = MatchModel::find($this->regView->id);
			$match->local_manager_id = $match->localTeam->team->manager_id;
			$match->visitor_manager_id = $match->visitorTeam->team->manager_id;
			$match->save();
		}

		$this->createMatchPosts($this->regView->id);

    	session()->flash('success', 'BoxScore guardado correctamente.');
        $this->emit('closeBoxscoreModal');
        $this->closeAnyModal();
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
				'updated_user_id' => auth()->user()->id,
			]);
		}

		$match = MatchModel::find($this->regView->id);
		$match->extra_times = $this->extra_times ?: 0;
		$match->played = $match->played() ? 1 : 0;
		$match->save();
	}

	public function storePlayerStats()
	{
		foreach ($this->players_stats as $key => $player_stat) {
			if ($player_stat['MIN'] > 0) {
				$PTS = $player_stat['PTS'] == null && $player_stat['PTS'] !== 0 ? null : $player_stat['PTS'];
				$REB = $player_stat['REB'] == null && $player_stat['REB'] !== 0 ? null : $player_stat['REB'];
				$AST = $player_stat['AST'] == null && $player_stat['AST'] !== 0 ? null : $player_stat['AST'];
				$STL = $player_stat['STL'] == null && $player_stat['STL'] !== 0 ? null : $player_stat['STL'];
				$BLK = $player_stat['BLK'] == null && $player_stat['BLK'] !== 0 ? null : $player_stat['BLK'];
				$LOS = $player_stat['LOS'] == null && $player_stat['LOS'] !== 0 ? null : $player_stat['LOS'];
				$FGM = $player_stat['FGM'] == null && $player_stat['FGM'] !== 0 ? null : $player_stat['FGM'];
				$FGA = $player_stat['FGA'] == null && $player_stat['FGA'] !== 0 ? null : $player_stat['FGA'];
				$TPM = $player_stat['TPM'] == null && $player_stat['TPM'] !== 0 ? null : $player_stat['TPM'];
				$TPA = $player_stat['TPA'] == null && $player_stat['TPA'] !== 0 ? null : $player_stat['TPA'];
				$FTM = $player_stat['FTM'] == null && $player_stat['FTM'] !== 0 ? null : $player_stat['FTM'];
				$FTA = $player_stat['FTA'] == null && $player_stat['FTA'] !== 0 ? null : $player_stat['FTA'];
				$ORB = $player_stat['ORB'] == null && $player_stat['ORB'] !== 0 ? null : $player_stat['ORB'];
				$PF = $player_stat['PF'] == null && $player_stat['PF'] !== 0 ? null : $player_stat['PF'];
				$ML = $player_stat['ML'] == null && $player_stat['ML'] !== 0 ? null : $player_stat['ML'];
				$headline = $player_stat['headline'];
			} else {
				$PTS = null;
				$REB = null;
				$AST = null;
				$STL = null;
				$BLK = null;
				$LOS = null;
				$FGM = null;
				$FGA = null;
				$TPM = null;
				$TPA = null;
				$FTM = null;
				$FTA = null;
				$ORB = null;
				$PF = null;
				$ML = null;
				$headline = 0;
			}
			$playerStat = PlayerStat::create([
				'match_id' => $this->regView->id,
				'season_id' => $this->regView->season_id,
				'player_id' => $player_stat['player_id'],
				'injury_id' => $player_stat['injury_id'],
				'injury_matches' => $player_stat['injury_matches'],
				'injury_days' => $player_stat['injury_days'],
				'injury_playable' => $player_stat['injury_playable'],
				'season_team_id' => $player_stat['season_team_id'],
				'MIN' 		=> $player_stat['MIN'] == null && $player_stat['MIN'] !== 0 ? null : $player_stat['MIN'],
				'PTS' 		=> $PTS,
				'REB' 		=> $REB,
				'AST' 		=> $AST,
				'STL' 		=> $STL,
				'BLK' 		=> $BLK,
				'LOS' 		=> $LOS,
				'FGM' 		=> $FGM,
				'FGA' 		=> $FGA,
				'TPM' 		=> $TPM,
				'TPA' 		=> $TPA,
				'FTM' 		=> $FTM,
				'FTA' 		=> $FTA,
				'ORB' 		=> $ORB,
				'PF' 		=> $PF,
				'ML' 		=> $ML,
				'headline' 	=> $headline,
				'updated_user_id' => auth()->user()->id,
			]);

			if ($player_stat['injury_id'] > 0) {
				$player = Player::find($player_stat['player_id']);

				$before = $player->toJson(JSON_PRETTY_PRINT);
				if ($player->injury_matches == 1) {
					$player->injury_id = null;
					$player->injury_matches = null;
					$player->injury_days = null;
					$player->injury_playable = 0;
				} else {
					$player->injury_matches = $player->injury_matches - 1;
				}
				$player->save();

				event(new TableWasUpdated($player, 'update', $player->toJson(JSON_PRETTY_PRINT), $before));
			}
		}

		$this->regView = MatchModel::find($this->regView->id);
		$this->regView->teamStats_state = $this->regView->checkTeamStats();
		$this->regView->playerStats_state = $this->regView->checkPlayerStats();
		$this->regView->save();
	}

	public function storeTeamStats()
	{
		foreach ($this->teams_stats as $key => $team_stat) {
			$teamStat = TeamStat::create([
				'match_id' 			=> $this->regView->id,
				'season_id' 		=> $this->regView->season_id,
				'season_team_id' 	=> $team_stat['season_team_id'] == null && $team_stat['season_team_id'] !== 0 ? null : $team_stat['season_team_id'],
				'counterattack'  	=> $team_stat['counterattack'] == null && $team_stat['counterattack'] !== 0 ? null : $team_stat['counterattack'],
				'zone' 			 	=> $team_stat['zone'] == null && $team_stat['zone'] !== 0 ? null : $team_stat['zone'],
				'second_oportunity' => $team_stat['second_oportunity'] == null && $team_stat['second_oportunity'] !== 0 ? null : $team_stat['second_oportunity'],
				'substitute' 		=> $team_stat['substitute'] == null && $team_stat['substitute'] !== 0 ? null : $team_stat['substitute'],
				'advantage' 		=> $team_stat['advantage'] == null && $team_stat['advantage'] !== 0 ? null : $team_stat['advantage'],
				'AST' 				=> $team_stat['AST'] == null && $team_stat['AST'] !== 0 ? null : $team_stat['AST'],
				'DRB' 				=> $team_stat['DRB'] == null && $team_stat['DRB'] !== 0 ? null : $team_stat['DRB'],
				'ORB' 				=> $team_stat['ORB'] == null && $team_stat['ORB'] !== 0 ? null : $team_stat['ORB'],
				'STL' 				=> $team_stat['STL'] == null && $team_stat['STL'] !== 0 ? null : $team_stat['STL'],
				'BLK' 				=> $team_stat['BLK'] == null && $team_stat['BLK'] !== 0 ? null : $team_stat['BLK'],
				'LOS' 				=> $team_stat['LOS'] == null && $team_stat['LOS'] !== 0 ? null : $team_stat['LOS'],
				'PF' 				=> $team_stat['PF'] == null && $team_stat['PF'] !== 0 ? null : $team_stat['PF'],
				'updated_user_id' 	=> auth()->user()->id,
			]);
		}

		$this->regView = MatchModel::find($this->regView->id);
		$this->regView->teamStats_state = $this->regView->checkTeamStats();
		$this->regView->playerStats_state = $this->regView->checkPlayerStats();
		$this->regView->save();
	}

	public function updateMatch($id)
	{
		$match = MatchModel::find($id);

		if ($match->scores->count() > 0) {
			$this->updateResult($match);
		} else {
			$this->storeResult();
		}

		if ($match->playerStats->count() > 0) {
			$this->updatePlayerStats($match);
		} else {
			$this->storePlayerStats();
		}

		if ($match->teamStats->count() > 0) {
			$this->updateTeamStats($match);
		} else {
			$this->storeTeamStats();
		}

		//update local and visitor manager_id
		if ($this->update_match_managers) {
			$match->local_manager_id = $match->localTeam->team->manager_id;
			$match->visitor_manager_id = $match->visitorTeam->team->manager_id;
			$match->save();
		}

    	session()->flash('success', 'BoxScore actualizado correctamente.');
    	$this->emit('closeBoxscoreModal');
        $this->closeAnyModal();
	}

	public function updateResult($match)
	{
		foreach ($this->scores as $key => $score_temp) {
			$score = Score::where('match_id', $match->id)->where('seasons_scores_headers_id', $score_temp['seasons_scores_headers_id'])->first();
			$score->local_score = $score_temp['local_score'] ?: 0;
			$score->visitor_score = $score_temp['visitor_score'] ?: 0;
			$score->updated_user_id = auth()->user()->id;
			$score->save();
		}

		$match->extra_times = $this->extra_times ?: 0;
		$match->played = $match->played() ? 1 : 0;
		$match->save();
	}

	public function updatePlayerStats($match)
	{
		foreach ($this->players_stats as $key => $player_stat) {
			$playerStat = PlayerStat::where('match_id', $match->id)->where('player_id', $player_stat['player_id'])->first();
			$playerStat->injury_id = $player_stat['injury_id'];
			$playerStat->injury_matches = $player_stat['injury_matches'];
			$playerStat->injury_days = $player_stat['injury_days'];
			$playerStat->injury_playable = $player_stat['injury_playable'];
			$playerStat->MIN = $player_stat['MIN'] == null && $player_stat['MIN'] !== 0 ? null : $player_stat['MIN'];
			if ($player_stat['MIN'] > 0) {
				$playerStat->PTS = $player_stat['PTS'] == null && $player_stat['PTS'] !== 0 ? null : $player_stat['PTS'];
				$playerStat->REB = $player_stat['REB'] == null && $player_stat['REB'] !== 0 ? null : $player_stat['REB'];
				$playerStat->AST = $player_stat['AST'] == null && $player_stat['AST'] !== 0 ? null : $player_stat['AST'];
				$playerStat->STL = $player_stat['STL'] == null && $player_stat['STL'] !== 0 ? null : $player_stat['STL'];
				$playerStat->BLK = $player_stat['BLK'] == null && $player_stat['BLK'] !== 0 ? null : $player_stat['BLK'];
				$playerStat->LOS = $player_stat['LOS'] == null && $player_stat['LOS'] !== 0 ? null : $player_stat['LOS'];
				$playerStat->FGM = $player_stat['FGM'] == null && $player_stat['FGM'] !== 0 ? null : $player_stat['FGM'];
				$playerStat->FGA = $player_stat['FGA'] == null && $player_stat['FGA'] !== 0 ? null : $player_stat['FGA'];
				$playerStat->TPM = $player_stat['TPM'] == null && $player_stat['TPM'] !== 0 ? null : $player_stat['TPM'];
				$playerStat->TPA = $player_stat['TPA'] == null && $player_stat['TPA'] !== 0 ? null : $player_stat['TPA'];
				$playerStat->FTM = $player_stat['FTM'] == null && $player_stat['FTM'] !== 0 ? null : $player_stat['FTM'];
				$playerStat->FTA = $player_stat['FTA'] == null && $player_stat['FTA'] !== 0 ? null : $player_stat['FTA'];
				$playerStat->ORB = $player_stat['ORB'] == null && $player_stat['ORB'] !== 0 ? null : $player_stat['ORB'];
				$playerStat->PF = $player_stat['PF'] == null && $player_stat['PF'] !== 0 ? null : $player_stat['PF'];
				$playerStat->ML = $player_stat['ML'] == null && $player_stat['ML'] !== 0 ? null : $player_stat['ML'];
				$playerStat->headline = $player_stat['headline'];
			} else {
				$playerStat->PTS = null;
				$playerStat->REB = null;
				$playerStat->AST = null;
				$playerStat->STL = null;
				$playerStat->BLK = null;
				$playerStat->LOS = null;
				$playerStat->FGM = null;
				$playerStat->FGA = null;
				$playerStat->TPM = null;
				$playerStat->TPA = null;
				$playerStat->FTM = null;
				$playerStat->FTA = null;
				$playerStat->ORB = null;
				$playerStat->PF = null;
				$playerStat->ML = null;
				$playerStat->headline = 0;
			}
			$playerStat->updated_user_id = auth()->user()->id;
			$playerStat->save();
		}

		$match = MatchModel::find($match->id);
		$match->teamStats_state = $match->checkTeamStats();
		$match->playerStats_state = $match->checkPlayerStats();
		$match->save();
	}

	public function updateTeamStats($match)
	{
		foreach ($this->teams_stats as $key => $team_stat) {
			$teamStat = TeamStat::where('match_id', $match->id)->where('season_team_id', $team_stat['season_team_id'])->first();
			if ($teamStat) {
				$teamStat->counterattack = $team_stat['counterattack'] == null && $team_stat['counterattack'] !== 0 ? null : $team_stat['counterattack'];
				$teamStat->zone = $team_stat['zone'] == null && $team_stat['zone'] !== 0 ? null : $team_stat['zone'];
				$teamStat->second_oportunity = $team_stat['second_oportunity'] == null && $team_stat['second_oportunity'] !== 0 ? null : $team_stat['second_oportunity'];
				$teamStat->substitute = $team_stat['substitute'] == null && $team_stat['substitute'] !== 0 ? null : $team_stat['substitute'];
				$teamStat->advantage = $team_stat['advantage'] == null && $team_stat['advantage'] !== 0 ? null : $team_stat['advantage'];
				$teamStat->AST = $team_stat['AST'] == null && $team_stat['AST'] !== 0 ? null : $team_stat['AST'];
				$teamStat->DRB = $team_stat['DRB'] == null && $team_stat['DRB'] !== 0 ? null : $team_stat['DRB'];
				$teamStat->ORB = $team_stat['ORB'] == null && $team_stat['ORB'] !== 0 ? null : $team_stat['ORB'];
				$teamStat->STL = $team_stat['STL'] == null && $team_stat['STL'] !== 0 ? null : $team_stat['STL'];
				$teamStat->BLK = $team_stat['BLK'] == null && $team_stat['BLK'] !== 0 ? null : $team_stat['BLK'];
				$teamStat->LOS = $team_stat['LOS'] == null && $team_stat['LOS'] !== 0 ? null : $team_stat['LOS'];
				$teamStat->PF = $team_stat['PF'] == null && $team_stat['PF'] !== 0 ? null : $team_stat['PF'];
				$teamStat->updated_user_id = auth()->user()->id;
				$teamStat->save();
			}
		}

		$match = MatchModel::find($match->id);
		$match->teamStats_state = $match->checkTeamStats();
		$match->playerStats_state = $match->checkPlayerStats();
		$match->save();
	}

    public function confirmResetMatch()
    {
		if (count($this->regsSelectedArray) > 0) {
			$this->emit('openResetMatchModal');
		}
    }

	public function resetMatch()
	{
    	$regs_to_reset = count($this->regsSelectedArray);
		$regs_reset = 0;
		foreach ($this->regsSelectedArray as $reg) {
	    	// $before = $reg->toJson(JSON_PRETTY_PRINT);
			if ($reg = MatchModel::find($reg)) {
				if ($reg->scores()->count() > 0 || $reg->playerStats()->count() > 0 || $reg->teamStats()->count() > 0) {
					$reg->scores()->delete();
					//restore injuries
					foreach ($reg->playerStats as $player_stat) {
						if ($player_stat->injury_id > 0) {
							$player = Player::find($player_stat->player_id);
							$before = $player->toJson(JSON_PRETTY_PRINT);

							$player->injury_id = $player_stat->injury_id;
							$player->injury_matches = $player_stat->injury_matches;
							$player->injury_days = $player_stat->injury_days;
							$player->injury_playable = $player_stat->injury_playable;

							$player->save();
							event(new TableWasUpdated($player, 'update', $player->toJson(JSON_PRETTY_PRINT), $before));
						}
					}
					$reg->playerStats()->delete();
					$reg->teamStats()->delete();
					$reg->posts()->delete();
					$reg->extra_times = null;
					$reg->played = 0;
					$reg->teamStats_state = 'error';
					$reg->playerStats_state = 'error';
					$reg->save();
					$regs_reset++;
					// event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));
					$this->createResetMatchPosts($reg->id);
				}
			}
		}
		if ($regs_reset > 0) {
			session()->flash('success', $regs_to_reset == 1 ? 'Registro reseteado correctamente!.' : 'Registros reseteados correctamente!.');
		} else {
			if ($regs_to_reset == 1) {
				session()->flash('error', 'El registro no puede ser reseteado o ya no existe.');
			} elseif ($regs_to_reset > 1) {
				session()->flash('error', 'No se ha reseteado ningún registro, no pueden ser reseteados o ya no existen.');
			}
		}
		$this->emit('closeResetMatchModal');

		$this->regsSelectedArray = [];
	}

    public function confirmResetScore()
    {
		if (count($this->regsSelectedArray) > 0) {
			$this->emit('openResetScoreModal');
		}
    }

	public function resetScore()
	{
    	$regs_to_reset = count($this->regsSelectedArray);
		$regs_reset = 0;
		foreach ($this->regsSelectedArray as $reg) {
	    	// $before = $reg->toJson(JSON_PRETTY_PRINT);
			if ($reg = MatchModel::find($reg)) {
				if ($reg->scores()->count() > 0) {
					$reg->scores()->delete();
					foreach ($reg->posts as $post) {
						if ($post->type == "resultados" || ($post->type == "records" && $post->team_id > 0) || ($post->type == "rachas" && $post->team_id > 0) || ($post->type == "destacados" && $post->team_id > 0)) {
							$post->delete();
						}
					}
					$reg->extra_times = null;
					$reg->played = 0;
					$reg->teamStats_state = 'error';
					$reg->playerStats_state = 'error';
					$reg->save();
					$regs_reset++;
					// event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));
					$this->createResetScorePosts($reg->id);
				}
			}
		}
		if ($regs_reset > 0) {
			session()->flash('success', $regs_to_reset == 1 ? 'Registro reseteado correctamente!.' : 'Registros reseteados correctamente!.');
		} else {
			if ($regs_to_reset == 1) {
				session()->flash('error', 'El registro no puede ser reseteado o ya no existe.');
			} elseif ($regs_to_reset > 1) {
				session()->flash('error', 'No se ha reseteado ningún registro, no pueden ser reseteados o ya no existen.');
			}
		}
		$this->emit('closeResetScoreModal');

		$this->regsSelectedArray = [];
	}

	protected function initializeScores()
	{
    	$this->scores = Collection::make();
		foreach ($this->season->scores_headers as $header) {
			$score['seasons_scores_headers_id'] = $header->id;
			$score['seasons_scores_headers_name'] = $header->scoreHeader->name;
			$score['local_score'] = null;
			$score['visitor_score'] = null;
			$this->scores->push($score);
		}

		$this->extra_times = null;
	}

	protected function initializePlayerStats()
	{
    	$players_stats = Collection::make();

    	// local players
    	$local_players = Player::where('team_id', $this->regView->localTeam->team->id)->where('retired', false)->orderBy('name', 'asc')->get();
		foreach ($local_players as $player) {
			$player_stat['player_id'] = $player->id;
			$player_stat['player_img'] = $player->getImg();
			$player_stat['player_name'] = $player->name;
			$player_stat['player_pos_ordered'] = $player->getPositionOrdered();
			$player_stat['player_pos'] = $player->getPosition();
			$player_stat['injury_id'] = $player->injury_id;
			$player_stat['injury_matches'] = $player->injury_matches;
			$player_stat['injury_days'] = $player->injury_days;
			$player_stat['injury_playable'] = $player->injury_playable;
			$player_stat['injury_name'] = $player->injury ? $player->injury->name : '';
			$player_stat['injuried'] = 0;
			if ($player->injury_id > 0 && !$player->injury_playable) {
				$player_stat['injuried'] = 1;
			}
			$player_stat['team_id'] = $this->regView->localTeam->team->id;
			$player_stat['season_team_id'] = $this->regView->localTeam->id;
			$player_stat['MIN'] = null;
			$player_stat['PTS'] = null;
			$player_stat['REB'] = null;
			$player_stat['AST'] = null;
			$player_stat['STL'] = null;
			$player_stat['BLK'] = null;
			$player_stat['LOS'] = null;
			$player_stat['FGM'] = null;
			$player_stat['FGA'] = null;
			$player_stat['TPM'] = null;
			$player_stat['TPA'] = null;
			$player_stat['FTM'] = null;
			$player_stat['FTA'] = null;
			$player_stat['ORB'] = null;
			$player_stat['PF'] = null;
			$player_stat['ML'] = null;
			$player_stat['headline'] = 0;

			$players_stats->push($player_stat);
		}
		// visitor players
		$visitor_players = Player::where('team_id', $this->regView->visitorTeam->team->id)->where('retired', false)->orderBy('name', 'asc')->get();
		foreach ($visitor_players as $player) {
			$player_stat['player_id'] = $player->id;
			$player_stat['player_img'] = $player->getImg();
			$player_stat['player_name'] = $player->name;
			$player_stat['player_pos_ordered'] = $player->getPositionOrdered();
			$player_stat['player_pos'] = $player->getPosition();
			$player_stat['injury_id'] = $player->injury_id;
			$player_stat['injury_matches'] = $player->injury_matches;
			$player_stat['injury_days'] = $player->injury_days;
			$player_stat['injury_playable'] = $player->injury_playable;
			$player_stat['injury_name'] = $player->injury ? $player->injury->name : '';
			$player_stat['injuried'] = 0;
			if ($player->injury_id > 0 && !$player->injury_playable) {
				$player_stat['injuried'] = 1;
			}
			$player_stat['team_id'] = $this->regView->visitorTeam->team->id;
			$player_stat['season_team_id'] = $this->regView->visitorTeam->id;
			$player_stat['MIN'] = null;
			$player_stat['PTS'] = null;
			$player_stat['REB'] = null;
			$player_stat['AST'] = null;
			$player_stat['STL'] = null;
			$player_stat['BLK'] = null;
			$player_stat['LOS'] = null;
			$player_stat['FGM'] = null;
			$player_stat['FGA'] = null;
			$player_stat['TPM'] = null;
			$player_stat['TPA'] = null;
			$player_stat['FTM'] = null;
			$player_stat['FTA'] = null;
			$player_stat['ORB'] = null;
			$player_stat['PF'] = null;
			$player_stat['ML'] = null;
			$player_stat['headline'] = 0;

			$players_stats->push($player_stat);
		}

		$criteria = [
			"injuried" => "asc",
            "headline" => "desc",
            "MIN" => "desc",
            "player_pos_ordered" => "asc",
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $players_stats->sort($comparer);
        $this->players_stats = $sorted->values()->toArray();
	}

	protected function initializeTeamStats()
	{
    	$this->teams_stats = Collection::make();

		$team_stat['season_team_id'] = $this->regView->localTeam->id;
		$team_stat['counterattack'] = null;
		$team_stat['zone'] = null;
		$team_stat['second_oportunity'] = null;
		$team_stat['substitute'] = null;
		$team_stat['advantage'] = null;
		$team_stat['AST'] = null;
		$team_stat['DRB'] = null;
		$team_stat['ORB'] = null;
		$team_stat['STL'] = null;
		$team_stat['BLK'] = null;
		$team_stat['LOS'] = null;
		$team_stat['PF'] = null;
		$this->teams_stats->push($team_stat);

    	$this->team_stats = Collection::make();
		$team_stat['season_team_id'] = $this->regView->visitorTeam->id;
		$team_stat['counterattack'] = null;
		$team_stat['zone'] = null;
		$team_stat['second_oportunity'] = null;
		$team_stat['substitute'] = null;
		$team_stat['advantage'] = null;
		$team_stat['AST'] = null;
		$team_stat['DRB'] = null;
		$team_stat['ORB'] = null;
		$team_stat['STL'] = null;
		$team_stat['BLK'] = null;
		$team_stat['LOS'] = null;
		$team_stat['PF'] = null;
		$this->teams_stats->push($team_stat);
	}

	protected function loadScores()
	{
    	$this->scores = Collection::make();
		foreach ($this->regView->scores as $sc) {
			$score['seasons_scores_headers_id'] = $sc->season_score_headers->id;
			$score['seasons_scores_headers_name'] = $sc->season_score_headers->scoreHeader->name;
			$score['local_score'] = $sc->local_score;
			$score['visitor_score'] = $sc->visitor_score;

			$this->scores->push($score);
		}

		$this->extra_times = $this->regView->extra_times;
	}

	protected function loadPlayerStats()
	{
    	$players_stats = Collection::make();
		foreach ($this->regView->playerStats as $ps) {
			$player_stat['player_id'] = $ps->player->id;
			$player_stat['player_img'] = $ps->player->getImg();
			$player_stat['player_name'] = $ps->player->name;
			$player_stat['player_pos_ordered'] = $ps->player->getPositionOrdered();
			$player_stat['player_pos'] = $ps->player->getPosition();
			$player_stat['injury_id'] = $ps->injury_id;
			$player_stat['injury_matches'] = $ps->injury_matches;
			$player_stat['injury_days'] = $ps->injury_days;
			$player_stat['injury_playable'] = $ps->injury_playable;
			$player_stat['injury_name'] = $ps->injury ? $ps->injury->name : '';
			$player_stat['injuried'] = 0;
			if ($ps->injury_id > 0 && !$ps->injury_playable) {
				$player_stat['injuried'] = 1;
			}
			$player_stat['team_id'] = $ps->seasonTeam->team_id;
			$player_stat['season_team_id'] = $ps->season_team_id;
			$player_stat['MIN'] = $ps->MIN;
			$player_stat['PTS'] = $ps->PTS;
			$player_stat['REB'] = $ps->REB;
			$player_stat['AST'] = $ps->AST;
			$player_stat['STL'] = $ps->STL;
			$player_stat['BLK'] = $ps->BLK;
			$player_stat['LOS'] = $ps->LOS;
			$player_stat['FGM'] = $ps->FGM;
			$player_stat['FGA'] = $ps->FGA;
			$player_stat['TPM'] = $ps->TPM;
			$player_stat['TPA'] = $ps->TPA;
			$player_stat['FTM'] = $ps->FTM;
			$player_stat['FTA'] = $ps->FTA;
			$player_stat['ORB'] = $ps->ORB;
			$player_stat['PF'] = $ps->PF;
			$player_stat['ML'] = $ps->ML;
			$player_stat['headline'] = $ps->headline;

			$players_stats->push($player_stat);
		}

		$criteria = [
			"injuried" => "asc",
            "headline" => "desc",
            "MIN" => "desc",
            "player_pos_ordered" => "asc",
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $players_stats->sort($comparer);
        $this->players_stats = $sorted->values()->toArray();
	}

	protected function loadTeamStats()
	{

    	$this->teams_stats = Collection::make();

    	$ts = $this->regView->localTeam_teamTotals();
    	if ($ts) {
			$team_stat['season_team_id'] = $ts->season_team_id;
			$team_stat['counterattack'] = $ts->counterattack;
			$team_stat['zone'] = $ts->zone;
			$team_stat['second_oportunity'] = $ts->second_oportunity;
			$team_stat['substitute'] = $ts->substitute;
			$team_stat['advantage'] = $ts->advantage;
			$team_stat['AST'] = $ts->AST;
			$team_stat['DRB'] = $ts->DRB;
			$team_stat['ORB'] = $ts->ORB;
			$team_stat['STL'] = $ts->STL;
			$team_stat['BLK'] = $ts->BLK;
			$team_stat['LOS'] = $ts->LOS;
			$team_stat['PF'] = $ts->PF;
			$this->teams_stats->push($team_stat);
    	} else {
			$team_stat['season_team_id'] = $this->regView->localTeam->id;
			$team_stat['counterattack'] = null;
			$team_stat['zone'] = null;
			$team_stat['second_oportunity'] = null;
			$team_stat['substitute'] = null;
			$team_stat['advantage'] = null;
			$team_stat['AST'] = null;
			$team_stat['DRB'] = null;
			$team_stat['ORB'] = null;
			$team_stat['STL'] = null;
			$team_stat['BLK'] = null;
			$team_stat['LOS'] = null;
			$team_stat['PF'] = null;
			$this->teams_stats->push($team_stat);
    	}

    	$ts = $this->regView->visitorTeam_teamTotals();
    	if ($ts) {
			$team_stat['season_team_id'] = $ts->season_team_id;
			$team_stat['counterattack'] = $ts->counterattack;
			$team_stat['zone'] = $ts->zone;
			$team_stat['second_oportunity'] = $ts->second_oportunity;
			$team_stat['substitute'] = $ts->substitute;
			$team_stat['advantage'] = $ts->advantage;
			$team_stat['AST'] = $ts->AST;
			$team_stat['DRB'] = $ts->DRB;
			$team_stat['ORB'] = $ts->ORB;
			$team_stat['STL'] = $ts->STL;
			$team_stat['BLK'] = $ts->BLK;
			$team_stat['LOS'] = $ts->LOS;
			$team_stat['PF'] = $ts->PF;
			$this->teams_stats->push($team_stat);
    	} else {
			$team_stat['season_team_id'] = $this->regView->visitorTeam->id;
			$team_stat['counterattack'] = null;
			$team_stat['zone'] = null;
			$team_stat['second_oportunity'] = null;
			$team_stat['substitute'] = null;
			$team_stat['advantage'] = null;
			$team_stat['AST'] = null;
			$team_stat['DRB'] = null;
			$team_stat['ORB'] = null;
			$team_stat['STL'] = null;
			$team_stat['BLK'] = null;
			$team_stat['LOS'] = null;
			$team_stat['PF'] = null;
			$this->teams_stats->push($team_stat);
    	}

		// foreach ($this->regView->teamStats as $ts) {
		// 	$team_stat['season_team_id'] = $ts->season_team_id;
		// 	$team_stat['counterattack'] = $ts->counterattack;
		// 	$team_stat['zone'] = $ts->zone;
		// 	$team_stat['second_oportunity'] = $ts->second_oportunity;
		// 	$team_stat['substitute'] = $ts->substitute;
		// 	$team_stat['advantage'] = $ts->advantage;
		// 	$team_stat['AST'] = $ts->AST;
		// 	$team_stat['DRB'] = $ts->DRB;
		// 	$team_stat['ORB'] = $ts->ORB;
		// 	$team_stat['STL'] = $ts->STL;
		// 	$team_stat['BLK'] = $ts->BLK;
		// 	$team_stat['LOS'] = $ts->LOS;
		// 	$team_stat['PF'] = $ts->PF;

		// 	$this->teams_stats->push($team_stat);
		// }
	}

	protected function createMatchPosts($match_id)
	{
		$match = MatchModel::find($match_id);

		if ($match->winner()) {
			$this->createResultPost($match);
			$this->createFeaturedPost($match);
			$this->createStreakPost($match);
		}
	}

	protected function createResetMatchPosts($match_id)
	{
		$match = MatchModel::find($match_id);

    	$post = $this->storePost(
			'general',
			$match->id,
			null,
			null,
			null,
			null,
			$match->localTeam->team->short_name . ' | ' . $match->visitorTeam->team->short_name,
			$match->localTeam->team->medium_name . '  ' . $match->score() . '  ' . $match->visitorTeam->team->medium_name,
			'La administración ha reseteado el resultado y estadísticas del partido.',
			null,
    	);
    	event(new PostStored($post));
	}

	protected function createResetScorePosts($match_id)
	{
		$match = MatchModel::find($match_id);

    	$post = $this->storePost(
			'general',
			$match->id,
			null,
			null,
			null,
			null,
			$match->localTeam->team->short_name . ' | ' . $match->visitorTeam->team->short_name,
			$match->localTeam->team->medium_name . '  ' . $match->score() . '  ' . $match->visitorTeam->team->medium_name,
			'La administración ha reseteado el resultado.',
			null,
    	);
    	event(new PostStored($post));
	}

	protected function createResultPost($match)
	{
		$descriptions = [
			$match->winner()->team->medium_name . ' logra la victoria frente a los ' . $match->loser()->team->medium_name . ' en el ' . $match->stadium,
			'Los ' . $match->winner()->team->medium_name . ' vencen a los ' . $match->loser()->team->medium_name . ' en el ' . $match->stadium,
			'Los ' . $match->loser()->team->medium_name . ' han caído derrotados ante los ' . $match->winner()->team->medium_name . ' en el ' . $match->stadium,
		];
		$description_index = rand(0,2);
		$description = $descriptions[$description_index];

		$description .= '.';

    	$post = $this->storePost(
			'resultados',
			$match->id,
			null,
			null,
			null,
			null,
			$match->localTeam->team->short_name . ' | ' . $match->visitorTeam->team->short_name,
			$match->localTeam->team->medium_name . '  ' . $match->score() . '  ' . $match->visitorTeam->team->medium_name,
			$description,
			null,
    	);
    	event(new PostStored($post));
	}

	protected function createFeaturedPost($match)
	{
		//votes
		$pollVotes = MatchPoll::where('match_id', $match->id)->count();
		if ($pollVotes > 4) {
			$votes_local = ($match->votes()['local'] / $votes) * 100;
			$votes_visitor = ($match->votes()['visitor'] / $votes) * 100;

			if ( $votes_local <= 20 && $match->localTeam == $match->winner() || $votes_visitor <= 20 && $match->visitorTeam == $match->winner() ) {
				$descriptions = [
					$match->winner()->team->name . ' dan la sorpresa al imponerse a ' . $match->loser()->team->name,
					$match->loser()->team->name . ' cayó de forma inesperada frente a ' . $match->winner()->team->name
				];
				$description_index = rand(0,1);
				$description = $descriptions[$description_index];
				$description .= '.';

		    	$post = $this->storePost(
					'destacados',
					$match->id,
					null,
					null,
					null,
					$match->winner()->team->id,
					'pronósticos' . ' | ' . $match->winner()->team->short_name,
					'Los ' . $match->winner()->team->medium_name . ' contra todo pronóstico',
					$description,
					$match->winner()->team->getImg(),
		    	);
		    	event(new PostStored($post));
			}
		}
	}

	protected function createStreakPost($match)
	{
	}

    protected function makeComparer($criteria)
    {
        $comparer = function ($first, $second) use ($criteria) {
            foreach ($criteria as $key => $orderType) {
                // normalize sort direction
                $orderType = strtolower($orderType);
                if ($first[$key] < $second[$key]) {
                    return $orderType === "asc" ? -1 : 1;
                } else if ($first[$key] > $second[$key]) {
                    return $orderType === "asc" ? 1 : -1;
                }
            }
            // all elements were equal
            return 0;
        };
        return $comparer;
    }
}
