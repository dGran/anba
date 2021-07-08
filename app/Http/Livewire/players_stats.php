<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Season;
use App\Models\PlayerStat;
use Livewire\WithPagination;

class players_stats extends Component
{
    use WithPagination;

	public $season;

    public $phase = "regular";
    public $order = "AVG_PTS";
    public $order_direction = "desc";
    public $filter_AGE = null;
    public $filter_PJ = 1;
    public $filter_SUM_MIN = 1;
    public $filter_AVG_MIN_min = 0.1;

    public function change_order($order)
    {
        if ($this->order == $order) {
            if ($this->order_direction == "asc") {
                $this->order_direction = "desc";
            } else {
                $this->order_direction = "asc";
            }
        } else {
            $this->order = $order;
            if ($this->order != 'player_name' && $this->order != 'teams.short_name') {
                $this->order_direction = "desc";
            } else {
                $this->order_direction = "asc";
            }
        }
        $this->page = 1;
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

    public function set_phase($phase)
    {
        $this->phase = $phase;
    }

    public function getPlayersStats()
    {
        $PlayersStats = PlayerStat::with('player', 'seasonTeam.team')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->select('player_id', 'season_team_id',
                    // \DB::raw("POSITION(' ' IN players.name) AS space_position"),
                    // \DB::raw("LEFT(players.name, POSITION(' ' IN players.name)-1) AS player_name"),
                    // \DB::raw("RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name)) AS player_surname"),
                    \DB::raw("CONCAT(RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name)), ', ', LEFT(players.name, POSITION(' ' IN players.name)-1)) AS player_name"),
                    // POSITION(' ' IN players.name)
                    // LEFT(players.name, 10)
                    \DB::raw('timestampdiff(YEAR, players.birthdate, now()) AS AGE'),
                    \DB::raw('SUM(MIN) as SUM_MIN'),
                    \DB::raw('AVG(MIN) as AVG_MIN'),
                    \DB::raw('AVG(PTS) as AVG_PTS'),
                    \DB::raw('SUM(PTS) as SUM_PTS'),
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('AVG(FGM) as AVG_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('AVG(FGA) as AVG_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('AVG(TPM) as AVG_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('AVG(TPA) as AVG_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('AVG(FTM) as AVG_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('AVG(FTA) as AVG_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('SUM(REB) as SUM_REB'),
                    \DB::raw('AVG(REB) as AVG_REB'),
                    \DB::raw('SUM(ORB) as SUM_ORB'),
                    \DB::raw('AVG(ORB) as AVG_ORB'),
                    \DB::raw('SUM(REB) - SUM(ORB)  as SUM_DRB'),
                    \DB::raw('AVG(REB) - AVG(ORB)  as AVG_DRB'),
                    \DB::raw('AVG(AST) as AVG_AST'),
                    \DB::raw('SUM(AST) as SUM_AST'),
                    \DB::raw('AVG(STL) as AVG_STL'),
                    \DB::raw('SUM(STL) as SUM_STL'),
                    \DB::raw('AVG(BLK) as AVG_BLK'),
                    \DB::raw('SUM(BLK) as SUM_BLK'),
                    \DB::raw('AVG(LOS) as AVG_LOS'),
                    \DB::raw('SUM(LOS) as SUM_LOS'),
                    \DB::raw('AVG(PF) as AVG_PF'),
                    \DB::raw('SUM(PF) as SUM_PF'),
                    \DB::raw('AVG(ML) as AVG_ML'),
                    \DB::raw('SUM(ML) as SUM_ML'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $PlayersStats = $PlayersStats->whereNull('matches.clash_id');
            // if ($this->order == "PER_FG" || $this->order == "PER_TP" || $this->order == "PER_FT") {
            //     $PlayersStats = $PlayersStats->having('PJ', '>', 39);
            // }
        } else {
            $PlayersStats = $PlayersStats->whereNotNull('matches.clash_id');
            // if ($this->order == "PER_FG" || $this->order == "PER_TP" || $this->order == "PER_FT") {
            //         $PlayersStats = $PlayersStats->having('PJ', '>', 6);
            //     }
        }
        $PlayersStats = $PlayersStats->where('players_stats.season_id', $this->season->id);
        if ($this->filter_SUM_MIN > 0) {
            $PlayersStats = $PlayersStats->having('SUM_MIN', '>', $this->filter_SUM_MIN);
        } else {
            $PlayersStats = $PlayersStats->having('SUM_MIN', '>=', 1);
            $this->filter_SUM_MIN = 1;
        }
        $PlayersStats = $PlayersStats->having('SUM_MIN', '>', $this->filter_SUM_MIN)
            ->having('PJ', '>', $this->filter_PJ)
            ->orderBy($this->order, $this->order_direction)
            ->orderBy('PJ', 'desc')
            ->orderBy('SUM_MIN', 'asc')
            ->orderBy('player_name', 'asc')
            ->groupBy('player_id', 'season_team_id')
            ->paginate(20);

        return $PlayersStats;
    }

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season;
		}
	}

    public function render()
    {
        return view('stats.players.index', [
            'players_stats' => $this->getPlayersStats(),
        ]);
    }
}
