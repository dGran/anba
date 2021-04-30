<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Season;
use App\Models\PlayerStat;

class Stats extends Component
{
	public $season;


	protected function getTopsPTS()
	{
        return PlayerStat::with('player')
            ->select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('SUM(PTS) as SUM_PTS'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('season_id', $this->season->id)
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('SUM_PTS', 'desc')
            ->groupBy('player_id')
            ->take(10)->get();
	}

	protected function getTopsAST()
	{
        return PlayerStat::with('player')
            ->select('player_id',
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('SUM(AST) as SUM_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('season_id', $this->season->id)
            ->orderBy('AVG_AST', 'desc')
            ->orderBy('SUM_AST', 'desc')
            ->groupBy('player_id',)
            ->take(10)->get();
	}

    protected function getTopsREB()
    {
        return PlayerStat::with('player')
            ->select('player_id',
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('SUM(REB) as SUM_REB'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('season_id', $this->season->id)
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('SUM_REB', 'desc')
            ->groupBy('player_id')
            ->take(10)->get();
    }

    protected function getTopsBLK()
    {
        return PlayerStat::with('player')
            ->select('player_id',
                \DB::raw('AVG(BLK) as AVG_BLK'),
                \DB::raw('SUM(BLK) as SUM_BLK'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('season_id', $this->season->id)
            ->orderBy('AVG_BLK', 'desc')
            ->orderBy('SUM_BLK', 'desc')
            ->groupBy('player_id')
            ->take(10)->get();
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
        	'tops_PTS' => $this->getTopsPTS(),
        	'tops_AST' => $this->getTopsAST(),
        	'tops_REB' => $this->getTopsREB(),
        	'tops_BLK' => $this->getTopsBLK(),
        ]);
    }
}
