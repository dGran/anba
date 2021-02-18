<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Match;
use App\Models\MatchPoll;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\SeasonConference;
use App\Models\SeasonDivision;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class Matches extends Component
{
	use WithPagination;

	//boxscore
	public $scores;
	public $teams_table_data;

	public $regEdit;
	public $forecastsModal = false;


	//filters
	public $season;
	public $search = "";
	public $perPage = '5';
	public $team = "all";
	public $hidePlayed = false;
	public $manager = "all";
	public $order = 'lastPlayed';

	public $blank_view = false;

	// queryString
	protected $queryString = [
		'season',
		'search' => ['except' => ''],
		'team' => ['except' => "all"],
		'manager' => ['except' => "all"],
		'hidePlayed' => ['except' => false],
		'perPage' => ['except' => '5'],
		'order' => ['except' => 'lastPlayed'],
	];

    // Pagination
    public function setNextPage()
    {
    	$this->page++;
    }

    public function setPreviousPage()
    {
		$this->page--;
    }

	public function setOrder($name)
	{
    	$this->order = $name;
    	$this->page = 1;
	}

	public function pollVote($match_id, $vote)
	{
		MatchPoll::create([
			'match_id'	=> $match_id,
			'user_id'	=> auth()->user()->id,
			'vote'		=> $vote
		]);
	}

	public function pollDestroy($match_id, $user_id)
	{
		$poll = MatchPoll::where('match_id', $match_id)->where('user_id', $user_id)->first();
		if ($poll) {
			$poll->delete();
		}
	}

	public function openForecastsModal($match_id)
	{
		if ($this->regEdit = Match::find($match_id)) {
			$this->forecastsModal = true;
		}
	}

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season->slug;
		} else {
			$this->blank_view = true;
		}
		// dd('mount');
	}

    public function render()
    {
    	// dd('render');
    	if (!$this->blank_view) {
    		$current_season = Season::where('slug', $this->season)->first();
    		$seasons = Season::orderBy('id', 'desc')->get();
	    	$season_teams = SeasonTeam::
	    	leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
	    	->select('seasons_teams.*')
	    	->where('season_id', $current_season->id)
	    	->orderBy('teams.medium_name', 'asc')
	    	->get();
	    	$managers = SeasonTeam::
	    	leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
	    	->leftJoin('users', 'users.id', 'teams.manager_id')
	    	->where('season_id', $current_season->id)
	    	->whereNotNull('teams.manager_id')
	    	->select('users.*')
	    	->distinct()
	    	->orderBy('users.name', 'asc')
	    	->get();

	    	// $this->set_teams_table_data();

	        return view('matches.index', [
	        			'regs' => $this->getData(),
			        	'current_season' => $current_season,
			        	'seasons' => $seasons,
	        			'season_teams' => $season_teams,
	        			'managers' => $managers,
	        			'scores' => $this->scores,
	        		]);
    	} else {
	        return view('matches.index', [
	        ]);
    	}
    }

	protected function getData()
	{
    	$regs = Match::
            leftJoin('scores', 'scores.match_id', 'matches.id')
   			->leftJoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftJoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->season($this->season)
    		->name($this->search)
    		->team($this->team)
    		->user($this->manager)
            ->hidePlayed($this->hidePlayed)
			->select('matches.*')
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->groupBy('matches.id', 'scores.created_at')
			->paginate($this->perPage)->onEachSide(2);

	    if (($regs->total() > 0 && $regs->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $regs->lastPage();
		}

    	$regs = Match::
            leftJoin('scores', 'scores.match_id', 'matches.id')
   			->leftJoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
   			->leftJoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })
            ->season($this->season)
    		->name($this->search)
    		->team($this->team)
    		->user($this->manager)
            ->hidePlayed($this->hidePlayed)
			->select('matches.*')
			->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
			->orderBy('matches.id', 'desc')
			->groupBy('matches.id', 'scores.created_at')
			->paginate($this->perPage)->onEachSide(2);

		return $regs;
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
            'lastPlayed' => [
                'field'     => 'scores.created_at',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }


    // not functional -- more slow query
    public function set_teams_table_data()
    {
    	$current_season = Season::where('slug', $this->season)->first();

    	$seasons_conferences = SeasonConference::
    		leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
    		->select('seasons_conferences.*', 'conferences.name')
    		->where('season_id', $current_season->id)
    		->orderBy('conferences.name')
    		->get();
    	$seasons_divisions = SeasonDivision::
    		leftJoin('divisions', 'divisions.id', 'seasons_divisions.division_id')
    		->leftJoin('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
    		->leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
    		->select('seasons_divisions.*', 'divisions.name')
    		->where('seasons_divisions.season_id', $current_season->id)
    		->orderBy('conferences.name', 'asc')
    		->orderBy('divisions.name', 'asc')
    		->get();
		foreach ($seasons_conferences as $key => $conference) {
        	$table_positions_conference[$key] = $current_season->generateTable('conference', 'wavg', $conference->id, null);
    	}
		foreach ($seasons_divisions as $key => $division) {
        	$table_positions_division[$key] = $current_season->generateTable('division', 'wavg', null, $division->id);
    	}

    	$teams_table_data = [];

    	$season_teams = $current_season->teams;
		foreach ($season_teams as $team) {
	        foreach ($table_positions_conference as $key => $positions) {
		        foreach ($positions as $key => $pos) {
		            if ($pos['team']->id == $team->id) {
		            	$data['conference_position'] = $key+1;
		            	$data['w'] = $pos['w'];
		            	$data['l'] = $pos['l'];
		            	$data['streak'] = $pos['streak'];
		            	$data['last10_w'] = $pos['last10_w'];
		            	$data['last10_l'] = $pos['last10_l'];
		            }
		        }
	        }
	        foreach ($table_positions_division as $key => $positions) {
		        foreach ($positions as $key => $pos) {
		            if ($pos['team']->id == $team->id) {
		            	$data['division_position'] = $key+1;
		            }
		        }
	        }
            $teams_table_data[$team->id] = [
				'team' => $team,
				'conference_position' => $data['conference_position'],
				'division_position' => $data['division_position'],
				'w' => $data['w'],
				'l' => $data['l'],
				'streak' => $data['streak'],
				'last10_w' => $data['last10_w'],
				'last10_l' => $data['last10_l'],
			];
		}

		$this->teams_table_data = $teams_table_data;
    }
}
