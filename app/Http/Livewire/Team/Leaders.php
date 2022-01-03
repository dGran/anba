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
    public $phase = "regular";

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

    public function getTopsSimpleStat($stat)
    {
        return $stat = PlayerStat::with('player')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->select('player_id',
                \DB::raw('AVG('.$stat.') as AVG_'.$stat),
                \DB::raw('SUM('.$stat.') as SUM_'.$stat),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('AVG_'.$stat, 'desc')
            ->orderBy('SUM_'.$stat, 'desc')
            ->groupBy('player_id')
            ->take(3)->get();
    }

    protected function getTopsFG()
    {
         $stat = PlayerStat::with('player')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id',
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        // if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        // } else {
            // $stat = $stat->whereNotNull('matches.clash_id');
        // }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('PER_FG', 'desc')
            ->orderBy('SUM_FGA', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();

        return $stat;
    }

    protected function getTopsFT()
    {
         $stat = PlayerStat::with('player')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id',
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        // if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        // } else {
            // $stat = $stat->whereNotNull('matches.clash_id');
        // }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('PER_FT', 'desc')
            ->orderBy('SUM_FTA', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();

        return $stat;
    }

    protected function getTopsTP()
    {
         $stat = PlayerStat::with('player')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->select('player_id',
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        // if ($this->phase == "regular") {
            $stat = $stat->whereNull('matches.clash_id');
        // } else {
            // $stat = $stat->whereNotNull('matches.clash_id');
        // }
        $stat = $stat->where('players_stats.season_id', $this->season->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->orderBy('PER_TP', 'desc')
            ->orderBy('SUM_TPA', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();

        return $stat;
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
            'stats_PPG' => $this->getTopsSimpleStat('PTS'),
            'stats_RPG' => $this->getTopsSimpleStat('REB'),
            'stats_APG' => $this->getTopsSimpleStat('AST'),
            'stats_SPG' => $this->getTopsSimpleStat('STL'),
            'stats_BPG' => $this->getTopsSimpleStat('BLK'),
            'stats_FGPG' => $this->getTopsFG(),
            'stats_FTPG' => $this->getTopsFT(),
            'stats_TPPG' => $this->getTopsTP(),
        ]);
    }
}
