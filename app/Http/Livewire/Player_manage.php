<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;
use App\Models\SeasonTeam;

class Player_manage extends Component
{
    public $player;
    public $playerInfoStats;

    public function mount($player)
    {
        $this->player = $player;

        $current_season = Season::where('current', 1)->first();
        $season_team = SeasonTeam::where('season_id', $current_season->id)->where('team_id', $this->player->team->id)->first();
        $this->playerInfoStats = PlayerStat::
            join('matches', 'matches.id', 'players_stats.match_id')
            ->join('players', 'players.id', 'players_stats.player_id')
            ->select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('players_stats.player_id', $this->player->id)
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $current_season->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players_stats.season_team_id', $season_team->id)
            ->get();
    }

    public function render()
    {
        return view('player.index', [
            //..
        ]);
    }
}
