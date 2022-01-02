<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;
use App\Models\SeasonTeam;

class Leaders extends Component
{
    public $team;
    public $season_team;
    public $season;
    public $seasonType = "regular";

    public $playerInfo, $playerInfoStats;
    public $playerInfoModal = false;

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

    public function getPPG()
    {
        return $stat = PlayerStat::with('player')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('SUM(PTS) as SUM_PTS'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('SUM_PTS', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();
    }

    public function getRPG()
    {
        return $stat = PlayerStat::with('player')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->select('player_id',
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('SUM(REB) as SUM_REB'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('SUM_REB', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();
    }

    public function getAPG()
    {
        return $stat = PlayerStat::with('player')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->select('player_id',
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('SUM(AST) as SUM_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('AVG_AST', 'desc')
            ->orderBy('SUM_AST', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();
    }

	public function mount($team)
	{
		$this->team = $team;
        $current_season = Season::where('current', 1)->first();
        $this->season = $current_season;
        $this->season_team = SeasonTeam::where('season_id', $this->season->id)->where('team_id', $this->team->id)->first();
	}

    public function render()
    {
        return view('team.leaders.index', [
            'stats_PPG' => $this->getPPG(),
            'stats_RPG' => $this->getRPG(),
            'stats_APG' => $this->getAPG(),
        ]);
    }
}
