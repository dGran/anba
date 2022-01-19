<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Season;
use App\Models\SeasonTeam;

class TeamStats extends Component
{
    public $t;
    public $team;

    public $season_team;
    public $season;
    public $current_season;
    public $phase = "all";
    public $mode = "per_game";
    public $order = "AVG_PTS";
    public $order_direction = "desc";

    // queryString
    protected $queryString = [
        't',
        'season',
        'phase' => ['except' => "all"],
        'mode' => ['except' => "per_game"],
        'order',
        'order_direction',
    ];

    public function change_team($team)
    {
        $this->season_team = SeasonTeam::find($team);
        $this->t = $this->season_team->team->slug;
        $this->team = $this->season_team->team;
    }

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
        $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
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

        return view('team.team_stats.index', [
            'seasons'           => $seasons,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
