<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Match;

class Schedule extends Component
{
    public $team;

    public $season_team;
    public $season;
    public $current_season;
    public $phase = "regular";
    public $rival = 'all';
    public $rivals;

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
        $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
        $this->rivals = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', '<>', $this->team->id)->get();
    }

    public function getResults()
    {
        $regs = Match::
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

            ->season($this->current_season->slug)
            // ->phase($this->phase)
            // ->phase($this->phase)
            // ->team($this->season_team->id)
            ->teamandrival($this->season_team->id, $this->rival)
            // ->user($this->manager)
            // ->hidePlayed($this->hidePlayed)
            ->where('played', 1)
            ->select('matches.*')
            // ->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
            ->orderBy('scores.created_at', 'desc')
            ->groupBy('matches.id', 'scores.created_at')
            ->get();

        return $regs;
    }

	public function mount($team)
	{
        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season = $season->slug;
            $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
            $this->rivals = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', '<>', $this->team->id)->get();
        }
	}

    public function render()
    {
        $seasons = Season::orderBy('name', 'desc')->get();
        $more_teams = SeasonTeam::
            leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_id', $this->current_season->id)
            // ->where('seasons_teams.id', '<>', $this->season_team->id)
            ->orderBy('teams.short_name')
            ->get();

        $prior_team = null;
        $next_team = null;
        foreach ($more_teams as $index => $season_team) {

            if ($season_team->id == $this->season_team->id) {
                if ($index-1 >= 0) {
                    $prior_team = $more_teams[$index-1]->team->slug;
                } else {
                    $prior_team = $more_teams[$more_teams->count()-1]->team->slug;
                }
                if ($index+1 < $more_teams->count()) {
                    $next_team = $more_teams[$index+1]->team->slug;
                } else {
                    $next_team = $more_teams[0]->team->slug;
                }
            }
        }

        return view('team.schedule.index', [
            'results'           => $this->getResults(),
            'seasons'           => $seasons,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
