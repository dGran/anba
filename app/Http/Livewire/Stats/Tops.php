<?php

namespace App\Http\Livewire\Stats;

use Livewire\Component;
use App\Models\Season;
use App\Models\PlayerStat;

class Tops extends Component
{
    public $current_season;

	public $season;
    public $phase = "regular";

    // queryString
    protected $queryString = [
        'season',
        'phase' => ['except' => "regular"],
    ];

    public function set_phase($phase)
    {
        $this->phase = $phase;
    }

    public function change_season()
    {
        $season = Season::where('slug', $this->season)->first();
        $this->current_season = $season;
    }

    public function getTopsSimpleStatAVG($stat)
    {
        $result = PlayerStat::with('player', 'seasonTeam')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->join('players', 'players.id', 'players_stats.player_id')
            ->select('player_id', 'season_team_id',
                \DB::raw('AVG('.$stat.') as AVG_'.$stat),
                \DB::raw('SUM('.$stat.') as SUM_'.$stat),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('players_stats.season_id', $this->current_season->id)
            ->whereNotNull('players_stats.MIN');

            if ($this->phase == "regular") {
                $result = $result->whereNull('matches.clash_id');
            } else {
                $result = $result->whereNotNull('matches.clash_id');
            }
            $result = $result
                ->orderBy('AVG_'.$stat, 'desc')
                ->orderBy('SUM_'.$stat, 'desc');
            $result = $result
                ->groupBy('player_id')
                ->take(5)
                ->get();
            //groupBy('player_id', 'season_team_id')

        return $result;
    }

    public function getTopsSimpleStatSUM($stat)
    {
        $result = PlayerStat::with('player', 'seasonTeam')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->join('players', 'players.id', 'players_stats.player_id')
            ->select('player_id', 'season_team_id',
                \DB::raw('AVG('.$stat.') as AVG_'.$stat),
                \DB::raw('SUM('.$stat.') as SUM_'.$stat),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('players_stats.season_id', $this->current_season->id)
            ->whereNotNull('players_stats.MIN');

            if ($this->phase == "regular") {
                $result = $result->whereNull('matches.clash_id');
            } else {
                $result = $result->whereNotNull('matches.clash_id');
            }
            $result = $result
                ->orderBy('SUM_'.$stat, 'desc')
                ->orderBy('AVG_'.$stat, 'desc');
            $result = $result
                ->groupBy('player_id')
                ->take(3)
                ->get();
            //groupBy('player_id', 'season_team_id')

        return $result;
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
        $stat = $stat->where('players_stats.season_id', $this->current_season->id);
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
        $stat = $stat->where('players_stats.season_id', $this->current_season->id);
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
        $stat = $stat->where('players_stats.season_id', $this->current_season->id);
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
        $stat = $stat->where('players_stats.season_id', $this->current_season->id);
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

    public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season->slug;
            $this->current_season = $season;
		}
	}

    public function render()
    {
        $seasons = Season::orderBy('name', 'desc')->get();

        return view('stats.tops.index', [
            'seasons'       => $seasons,
        	'tops_PTS'      => $this->getTopsSimpleStatAVG('PTS'),
        	'tops_AST'      => $this->getTopsSimpleStatAVG('AST'),
        	'tops_REB'      => $this->getTopsSimpleStatAVG('REB'),
        	'tops_BLK'      => $this->getTopsSimpleStatAVG('BLK'),
            'tops_STL'      => $this->getTopsSimpleStatAVG('STL'),
            'tops_FG'       => $this->getTopsFG(),
            'tops_TP'       => $this->getTopsTP(),
            'tops_FT'       => $this->getTopsFT(),
            'tops_SUM_PTS'  => $this->getTopsSimpleStatSUM('PTS'),
            'tops_SUM_AST'  => $this->getTopsSimpleStatSUM('AST'),
            'tops_SUM_REB'  => $this->getTopsSimpleStatSUM('REB'),
            'tops_SUM_BLK'  => $this->getTopsSimpleStatSUM('BLK'),
            'tops_SUM_STL'  => $this->getTopsSimpleStatSUM('STL'),
            'tops_MVP'      => $this->getTopsMVP('all'),
            'top_PG'        => $this->getTopsMVP('pg'),
            'top_SG'        => $this->getTopsMVP('sg'),
            'top_SF'        => $this->getTopsMVP('sf'),
            'top_PF'        => $this->getTopsMVP('pf'),
            'top_C'         => $this->getTopsMVP('c'),
        ]);
    }
}
