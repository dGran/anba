<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\MatchModel;

class Schedule extends Component
{
    public $t;
    public $team;

    public $season_team;
    public $season;
    public $current_season;
    public $phase = "all";
    public $rival = 'all';
    public $rivals;
    public $matches_state = 'all';

    // queryString
    protected $queryString = [
        't',
        'season',
        'phase' => ['except' => "all"],
        'rival' => ['except' => "all"],
        'matches_state' => ['except' => "all"],
    ];

    public function change_team($team)
    {
        $this->season_team = SeasonTeam::find($team);
        $this->t = $this->season_team->team->slug;
        $this->team = $this->season_team->team;
        $this->rivals = SeasonTeam::
            join('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_id', $this->current_season->id)
            ->where('seasons_teams.id', '<>', $this->season_team->id)
            ->orderBy('teams.short_name')
            ->get();
        if ($this->season_team->id == $this->rival) {
            $this->rival = 'all';
        }
    }

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
        $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
        $this->rivals = SeasonTeam::
            join('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_id', $this->current_season->id)
            ->where('seasons_teams.id', '<>', $this->season_team->id)
            ->orderBy('teams.short_name')
            ->get();
        if ($this->rival != 'all') {
            $rival = SeasonTeam::find($this->rival);
            $this->rival = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $rival->team->id)->first()->id;
        }
    }

    public function getSchedule()
    {
        $regs = MatchModel::
            with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager', 'scores', 'playerStats.player', 'playerStats.seasonTeam.team')
            ->leftJoin('scores', 'scores.match_id', 'matches.id')
            ->leftJoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
            ->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            ->leftJoin('users', function($join){
                $join->on('users.id','=','matches.local_manager_id');
                $join->orOn('users.id','=','matches.visitor_manager_id');
            })

            ->season($this->current_season->slug);
            if ($this->phase != 'all') {
                $regs = $regs->phase($this->phase);
            }
            if ($this->matches_state != 'all') {
                if ($this->matches_state == 'played') {
                    $regs = $regs->where('played', 1);
                } else {
                    $regs = $regs->where('played', 0);
                }
            }
            $regs = $regs
            ->teamandrival($this->season_team->id, $this->rival)
            ->select('matches.*')
            ->orderBy('scores.created_at', 'desc')
            ->orderBy('matches.id', 'asc')
            ->groupBy('matches.id', 'scores.created_at')
            ->get();

        return $regs;
    }

    public function mount($team, $t, $season)
    {
        $this->team = $team;
        $this->t = $t;
        if (!$season) {
            $this->season = Season::where('current', 1)->first()->slug;
        } else {
            $this->season = $season;
        }

        $this->current_season = Season::where('slug', $this->season)->first();
        $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
        $this->rivals = SeasonTeam::
            join('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_id', $this->current_season->id)
            ->where('seasons_teams.id', '<>', $this->season_team->id)
            ->orderBy('teams.short_name')
            ->get();
    }

    public function render()
    {
        $seasons = Season::orderBy('name', 'desc')->get();
        $more_teams = SeasonTeam::
            leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_id', $this->current_season->id)
            ->orderBy('teams.short_name')
            ->get();

        $prior_team = null;
        $next_team = null;
        foreach ($more_teams as $index => $season_team) {

            if ($season_team->id == $this->season_team->id) {
                if ($index-1 >= 0) {
                    $prior_team = $more_teams[$index-1]->id;
                } else {
                    $prior_team = $more_teams[$more_teams->count()-1]->id;
                }
                if ($index+1 < $more_teams->count()) {
                    $next_team = $more_teams[$index+1]->id;
                } else {
                    $next_team = $more_teams[0]->id;
                }
            }
        }

        return view('team.schedule.index', [
            'results'           => $this->getSchedule(),
            'seasons'           => $seasons,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
