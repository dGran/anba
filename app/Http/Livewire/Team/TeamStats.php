<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Season;
use App\Models\SeasonTeam;

class TeamStats extends Component
{
    public $team;

    public $season_team;
    public $season;
    public $current_season;
    public $phase = "regular";

	public function mount($team)
	{
        $this->team = $team;

        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season = $season->slug;
            $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
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

        return view('team.team_stats.index', [
            'seasons'           => $seasons,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}