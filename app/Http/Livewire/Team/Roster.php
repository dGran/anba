<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;
use App\Models\SeasonTeam;

class Roster extends Component
{
    public $t;
    public $team;

    public $season_team;
    public $current_season;

    public $playerInfo, $playerInfoStats;
    public $playerInfoModal = false;

    // queryString
    protected $queryString = [
        't'
    ];

    public function change_team($team)
    {
        $this->season_team = SeasonTeam::find($team);
        $this->t = $this->season_team->team->slug;
        $this->team = $this->season_team->team;
    }

    public function openPlayerInfo($player_id)
    {
        $this->playerInfo = Player::find($player_id);
        $current_season = Season::where('current', 1)->first();

        $this->playerInfoStats = PlayerStat::
            join('matches', 'matches.id', 'players_stats.match_id')
            ->select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('player_id', $this->playerInfo->id)
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $current_season->id)
            ->get();


        $this->playerInfoModal = true;
    }

	public function mount($team, $t)
	{
		$this->team = $team;
        $this->t = $t;

        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
        }
	}

    public function render()
    {
        $players = Player::where('team_id', $this->team->id)->orderBy('position', 'asc')->orderBy('name', 'asc')->get();
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

        return view('team.roster.index', [
            'players'           => $players,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
