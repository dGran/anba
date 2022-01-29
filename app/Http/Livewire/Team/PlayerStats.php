<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;
use App\Models\SeasonTeam;

class PlayerStats extends Component
{
    public $t;
    public $team;

    public $season_team;
    public $season;
    public $current_season;
    public $season_is_current = true;
    public $phase = "all";
    public $mode = "per_game";
    public $current_roster = true;
    public $order = "AVG_PTS";
    public $order_direction = "desc";

    public $playerInfo, $playerInfoStats;
    public $playerInfoModal = false;

    // queryString
    protected $queryString = [
        't',
        'season',
        'phase' => ['except' => "all"],
        'mode' => ['except' => "per_game"],
        'current_roster' => ['except' => true],
        'order',
        'order_direction',
    ];

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
            // ->where('players.team_id', $this->team->id)
            ->where('players_stats.season_team_id', $this->season_team->id)
            ->get();

        $this->playerInfoModal = true;
    }

    public function change_team($team)
    {
        $this->season_team = SeasonTeam::find($team);
        $this->t = $this->season_team->team->slug;
        $this->team = $this->season_team->team;
    }

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
        $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
    }

    public function change_order($order)
    {
        if ($order != 'player_name' && $order != 'teams.short_name' && $order != 'AGE' && $order != 'PJ' && $order != 'PT' && $order != 'PER_FG' && $order != 'PER_TP' && $order != 'PER_FT') {
            if ($this->mode == "per_game") {
                $order = 'AVG_' . $order;
            } else {
                $order = 'SUM_' . $order;
            }
        }
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

    public function change_mode()
    {
        $pre_order = substr($this->order, 0, 3);
        $rest_order = substr($this->order, 4, strlen($this->order));
        if ($pre_order == 'AVG' || $pre_order == 'SUM') {
            if ($this->mode == "per_game") {
                $pre_order = 'AVG';
            } else {
                $pre_order = 'SUM';
            }
            $this->change_order_mode($rest_order);
        } else {
            $this->change_order_mode($this->order);
        }
    }

    public function change_order_mode($order)
    {
        if ($order != 'player_name' && $order != 'teams.short_name' && $order != 'AGE' && $order != 'PJ' && $order != 'PT' && $order != 'PER_FG' && $order != 'PER_TP' && $order != 'PER_FT') {
            if ($this->mode == "per_game") {
                $this->order = 'AVG_' . $order;
            } else {
                $this->order = 'SUM_' . $order;
            }
        }
        $this->page = 1;
    }

    public function getPlayersStats()
    {
        $PlayersStats = PlayerStat::with('player')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('player_id',
                    \DB::raw("CONCAT(RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name)), ', ', LEFT(players.name, POSITION(' ' IN players.name)-1)) AS player_name"),
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
                    \DB::raw('COUNT(player_id) as PJ'),
                    \DB::raw('SUM(headline) as PT'),
                );
        $PlayersStats = $PlayersStats->where('players_stats.season_id', $this->current_season->id);
        $PlayersStats = $PlayersStats->whereNotNull('players_stats.MIN');
        $PlayersStats = $PlayersStats->where('players_stats.season_team_id', $this->season_team->id);

        if ($this->current_roster && $this->season_is_current) {
            $PlayersStats = $PlayersStats->where('players.team_id', $this->team->id);
        }

        if ($this->phase != 'all') {
            if ($this->phase == "regular") {
                $PlayersStats = $PlayersStats->whereNull('matches.clash_id');
            } else {
                $PlayersStats = $PlayersStats->whereNotNull('matches.clash_id');
            }
        }

        $PlayersStats = $PlayersStats
            ->having('PJ', '>', 1)
            ->orderBy($this->order, $this->order_direction)
            ->orderBy('PJ', 'desc')
            ->orderBy('AVG_MIN', 'desc')
            ->orderBy('player_name', 'asc')
            ->groupBy('player_id')
            ->get();

        return $PlayersStats;
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
        $current = Season::where('current', 1)->first();
        $this->season_is_current = $this->current_season->id == $current->id;

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

        return view('team.player_stats.index', [
            'players_stats'     => $this->getPlayersStats(),
            'seasons'           => $seasons,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
