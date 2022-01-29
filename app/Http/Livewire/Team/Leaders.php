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
    public $t;
    public $team;

    public $season_team;
    public $season;
    public $current_season;
    public $phase = "all";
    public $mode = "per_game";

    public $playerInfo, $playerInfoStats;
    public $playerInfoModal = false;

    // queryString
    protected $queryString = [
        't',
        'season',
        'phase' => ['except' => "all"],
        'mode' => ['except' => "per_game"],
    ];

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
        $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
    }

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
            ->join('players', 'players.id', 'players_stats.player_id')
            ->select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('players_stats.player_id', $this->playerInfo->id)
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $current_season->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->get();

        $this->playerInfoModal = true;
    }

    public function getTopsSimpleStat($stat)
    {
        $result = PlayerStat::with('player')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->join('players', 'players.id', 'players_stats.player_id')
            ->select('player_id',
                \DB::raw('AVG('.$stat.') as AVG_'.$stat),
                \DB::raw('SUM('.$stat.') as SUM_'.$stat),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('players_stats.season_id', $this->current_season->id)
            // ->where('players_stats.season_team_id', $this->season_team->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players.team_id', $this->team->id);

        if ($this->phase != 'all') {
            if ($this->phase == "regular") {
                $result = $result->whereNull('matches.clash_id');
            } else {
                $result = $result->whereNotNull('matches.clash_id');
            }
        }
        if ($this->mode == "per_game") {
            $result = $result->orderBy('AVG_'.$stat, 'desc')->orderBy('SUM_'.$stat, 'desc');
        } else {
            $result = $result->orderBy('SUM_'.$stat, 'desc')->orderBy('AVG_'.$stat, 'desc');
        }
        $result = $result->groupBy('player_id')->take(3)->get();

        return $result;
    }

    protected function getTopsFG()
    {
         $stat = PlayerStat::with('player')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('player_id',
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase != 'all') {
            if ($this->phase == "regular") {
                $stat = $stat->whereNull('matches.clash_id');
            } else {
                $stat = $stat->whereNotNull('matches.clash_id');
            }
        }
        $stat = $stat->where('players_stats.season_id', $this->current_season->id)
            // ->where('players_stats.season_team_id', $this->season_team->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players.team_id', $this->team->id)
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
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('player_id',
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase != 'all') {
            if ($this->phase == "regular") {
                $stat = $stat->whereNull('matches.clash_id');
            } else {
                $stat = $stat->whereNotNull('matches.clash_id');
            }
        }
        $stat = $stat->where('players_stats.season_id', $this->current_season->id)
            // ->where('players_stats.season_team_id', $this->season_team->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players.team_id', $this->team->id)
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
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('player_id',
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('COUNT(player_id) as PJ')
                );
        if ($this->phase != 'all') {
            if ($this->phase == "regular") {
                $stat = $stat->whereNull('matches.clash_id');
            } else {
                $stat = $stat->whereNotNull('matches.clash_id');
            }
        }
        $stat = $stat->where('players_stats.season_id', $this->current_season->id)
            // ->where('players_stats.season_team_id', $this->season_team->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players.team_id', $this->team->id)
            ->orderBy('PER_TP', 'desc')
            ->orderBy('SUM_TPA', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();

        return $stat;
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

        return view('team.leaders.index', [
            'stats_PPG'         => $this->getTopsSimpleStat('PTS'),
            'stats_RPG'         => $this->getTopsSimpleStat('REB'),
            'stats_APG'         => $this->getTopsSimpleStat('AST'),
            'stats_SPG'         => $this->getTopsSimpleStat('STL'),
            'stats_BPG'         => $this->getTopsSimpleStat('BLK'),
            'stats_FGPG'        => $this->getTopsFG(),
            'stats_FTPG'        => $this->getTopsFT(),
            'stats_TPPG'        => $this->getTopsTP(),
            'seasons'           => $seasons,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
