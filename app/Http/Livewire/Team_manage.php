<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;

class Team_manage extends Component
{
    public $team;

    public $playerInfo, $playerInfoStats;
    public $playerInfoModal = false;
    public $op = 'roster';

    // queryString
    protected $queryString = [
        'op',
        // 'op' => ['except' => ''],
    ];

	public function mount($team)
	{
		$this->team = $team;
	}

    public function render()
    {
        $players = Player::where('team_id', $this->team->id)->orderBy('position', 'asc')->orderBy('name', 'asc')->get();
        return view('teams.team.index', [
            'players' => $players,
        ]);
    }

    public function changeOp($op)
    {
        $this->op = $op;
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
}
