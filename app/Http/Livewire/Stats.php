<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Season;
use App\Models\PlayerStat;
use Livewire\WithPagination;

class Stats extends Component
{
    use WithPagination;

	public $season;
    public $phase = "regular";

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

	protected function getTopsPTS()
	{
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('AVG(PTS) as AVG_PTS'),
                    \DB::raw('SUM(PTS) as SUM_PTS'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('SUM_PTS', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
	}

	protected function getTopsAST()
	{
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('AVG(AST) as AVG_AST'),
                    \DB::raw('SUM(AST) as SUM_AST'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->orderBy('AVG_AST', 'desc')
            ->orderBy('SUM_AST', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
	}

    protected function getTopsREB()
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('AVG(REB) as AVG_REB'),
                    \DB::raw('SUM(REB) as SUM_REB'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('SUM_REB', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
    }

    protected function getTopsBLK()
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('AVG(BLK) as AVG_BLK'),
                    \DB::raw('SUM(BLK) as SUM_BLK'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->orderBy('AVG_BLK', 'desc')
            ->orderBy('SUM_BLK', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
    }

    protected function getTopsSTL()
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('AVG(STL) as AVG_STL'),
                    \DB::raw('SUM(STL) as SUM_STL'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->orderBy('AVG_STL', 'desc')
            ->orderBy('SUM_STL', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
    }

    protected function getTopsFG()
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id);
        // if ($this->phase == "regular") {
        //     $stat = $stat->where('SUM_FGM', '>', 39);
        // }
        $stat = $stat->orderBy('PER_FG', 'desc')
            ->orderBy('SUM_FGA', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
    }

    protected function getTopsTP()
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id);
        // if ($this->phase == "regular") {
        //     $stat = $stat->where('SUM_TPM', '>', 39);
        // }
        $stat = $stat->orderBy('PER_TP', 'desc')
            ->orderBy('SUM_TPA', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
    }

    protected function getTopsFT()
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id);
        // if ($this->phase == "regular") {
        //     $stat = $stat->where('SUM_FTM', '>', 39);
        // }
        $stat = $stat->orderBy('PER_FT', 'desc')
            ->orderBy('SUM_FTA', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(5)->get();

        return $stat;
    }

    protected function getTopsMVP($position)
    {
        $stat = PlayerStat::with('player', 'seasonTeam')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('AVG(PTS) as AVG_PTS'),
                    \DB::raw('AVG(REB) as AVG_REB'),
                    \DB::raw('AVG(AST) as AVG_AST'),
                    \DB::raw('SUM(PTS + REB + AST) / COUNT(player_id) as AVG_TOTAL')
                );
        $stat = $stat->where('players_stats.season_id', $this->season->id);
        if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        if ($position != "all") {
            $stat = $stat->where('players.position', $position);
        }
        $stat = $stat->orderBy('AVG_TOTAL', 'desc')
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('AVG_AST', 'desc')
            ->groupBy('player_id', 'season_team_id');
        if ($position != "all") {
            $stat = $stat->first();
        } else {
            $stat = $stat->take(5)->get();
        }

        return $stat;
    }

    public function getPlayersStats()
    {
        $stat = PlayerStat::with('player', 'seasonTeam.team')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->select('player_id', 'season_team_id',
                    \DB::raw('timestampdiff(YEAR, players.birthdate, now()) AS AGE'),
                    \DB::raw('AVG(PTS) as AVG_PTS'),
                    \DB::raw('SUM(PTS) as SUM_PTS'),
                    \DB::raw('SUM(MIN) as SUM_MIN'),
                    \DB::raw('AVG(MIN) as AVG_MIN'),
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
            $stat = $stat->whereNull('matches.clash_id');
        } else {
            $stat = $stat->whereNotNull('matches.clash_id');
        }
        $stat = $stat->where('players_stats.season_id', $this->season->id);
        // if ($this->filter_SUM_MIN > 0) {
        //     $stat = $stat->having('SUM_MIN', '>', $this->filter_SUM_MIN);
        // } else {
        //     $stat = $stat->having('SUM_MIN', '>=', 1);
        //     $this->filter_SUM_MIN = 1;
        // }
        $stat = $stat->orderBy('PJ', 'desc')
            ->orderBy('SUM_MIN', 'asc')
            ->orderBy('players.name', 'asc')
            ->groupBy('player_id', 'season_team_id')
            ->paginate(20);

        return $stat;
    }

    public function getTeamsStats()
    {

    }


	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season;
		}
	}

    public function render()
    {
        return view('stats.index', [
        	'tops_PTS'      => $this->getTopsPTS(),
        	'tops_AST'      => $this->getTopsAST(),
        	'tops_REB'      => $this->getTopsREB(),
        	'tops_BLK'      => $this->getTopsBLK(),
            'tops_STL'      => $this->getTopsSTL(),
            'tops_FG'      => $this->getTopsFG(),
            'tops_TP'      => $this->getTopsTP(),
            'tops_FT'      => $this->getTopsFT(),
            'tops_MVP'      => $this->getTopsMVP('all'),
            'top_PG'      => $this->getTopsMVP('pg'),
            'top_SG'      => $this->getTopsMVP('sg'),
            'top_SF'      => $this->getTopsMVP('sf'),
            'top_PF'      => $this->getTopsMVP('pf'),
            'top_C'      => $this->getTopsMVP('c'),
            'players_stats' => $this->getPlayersStats(),
            'teams_stats'   => $this->getTeamsStats(),
        ]);
    }
}
