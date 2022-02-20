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

    public $statsPerGame_phase = "regular";
    public $statsPerGame_order = "seasons.name";
    public $statsPerGame_order_direction = "asc";

    public $statsTotals_phase = "regular";
    public $statsTotals_order = "seasons.name";
    public $statsTotals_order_direction = "asc";

    public $statsAdvanced_phase = "regular";
    public $statsAdvanced_order = "seasons.name";
    public $statsAdvanced_order_direction = "asc";

    public function statsPerGame_change_order($statsPerGame_order)
    {
        if ($statsPerGame_order != 'seasons.name' && $statsPerGame_order != 'team_name' && $statsPerGame_order != 'AGE' && $statsPerGame_order != 'PJ' && $statsPerGame_order != 'PT' && $statsPerGame_order != 'PER_FG' && $statsPerGame_order != 'PER_TP' && $statsPerGame_order != 'PER_FT') {
            $statsPerGame_order = 'AVG_' . $statsPerGame_order;
        }
        if ($this->statsPerGame_order == $statsPerGame_order) {
            if ($this->statsPerGame_order_direction == "asc") {
                $this->statsPerGame_order_direction = "desc";
            } else {
                $this->statsPerGame_order_direction = "asc";
            }
        } else {
            $this->statsPerGame_order = $statsPerGame_order;
            if ($this->statsPerGame_order != 'player_name' && $this->statsPerGame_order != 'teams.short_name') {
                $this->statsPerGame_order_direction = "desc";
            } else {
                $this->statsPerGame_order_direction = "asc";
            }
        }
        $this->page = 1;
    }

    public function getStatsPerGame()
    {
        $stats = PlayerStat::with('season', 'seasonTeam')
                ->join('seasons', 'seasons.id', 'players_stats.season_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('players_stats.season_id', 'players_stats.season_team_id', 'teams.short_name as team_name',
                    \DB::raw("timestampdiff(YEAR, players.birthdate, CONCAT(RIGHT(seasons.name, 4), '/01/01')) AS AGE"),
                    \DB::raw('AVG(MIN) as AVG_MIN'),
                    \DB::raw('AVG(PTS) as AVG_PTS'),
                    \DB::raw('AVG(FGM) as AVG_FGM'),
                    \DB::raw('AVG(FGA) as AVG_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('AVG(TPM) as AVG_TPM'),
                    \DB::raw('AVG(TPA) as AVG_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('AVG(FTM) as AVG_FTM'),
                    \DB::raw('AVG(FTA) as AVG_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('AVG(REB) as AVG_REB'),
                    \DB::raw('AVG(ORB) as AVG_ORB'),
                    \DB::raw('AVG(REB) - AVG(ORB)  as AVG_DRB'),
                    \DB::raw('AVG(AST) as AVG_AST'),
                    \DB::raw('AVG(STL) as AVG_STL'),
                    \DB::raw('AVG(BLK) as AVG_BLK'),
                    \DB::raw('AVG(LOS) as AVG_LOS'),
                    \DB::raw('AVG(PF) as AVG_PF'),
                    \DB::raw('AVG(ML) as AVG_ML'),
                    \DB::raw('COUNT(player_id) as PJ'),
                    \DB::raw('SUM(headline) as PT'),
                )
                ->where('player_id', $this->player->id)
                ->whereNotNull('players_stats.MIN');
                if ($this->statsPerGame_phase == 'regular') {
                    $stats = $stats->whereNull('matches.clash_id');
                } else {
                    $stats = $stats->whereNotNull('matches.clash_id');
                }
                $stats = $stats
                ->orderBy($this->statsPerGame_order, $this->statsPerGame_order_direction)
                ->orderBy('PJ', $this->statsPerGame_order_direction)
                ->orderBy('AVG_MIN', 'desc')
                ->groupBy('players_stats.season_team_id')
                ->having('PJ', '>', 1)
                ->get();

        return $stats;
    }

    public function getStatsPerGame_totals()
    {
        $stats = PlayerStat::with('season', 'seasonTeam')
                ->join('seasons', 'seasons.id', 'players_stats.season_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('players_stats.season_id', 'players_stats.season_team_id',
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
                )
                ->where('player_id', $this->player->id)
                ->whereNotNull('players_stats.MIN');
                if ($this->statsPerGame_phase == 'regular') {
                    $stats = $stats->whereNull('matches.clash_id');
                } else {
                    $stats = $stats->whereNotNull('matches.clash_id');
                }
                $stats = $stats
                ->groupBy('player_id')
                ->having('PJ', '>', 1)
                ->get();

        return $stats;
    }

    public function getStatsPerGame_team_totals()
    {
        $stats = PlayerStat::with('season', 'seasonTeam')
                ->join('seasons', 'seasons.id', 'players_stats.season_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('players_stats.season_id', 'players_stats.season_team_id', 'teams.short_name as team_name', 'teams.id as team_id',
                    \DB::raw("AVG(timestampdiff(YEAR, players.birthdate, CONCAT(RIGHT(seasons.name, 4), '/01/01'))) AS AGE"),
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
                )
                ->where('player_id', $this->player->id)
                ->whereNotNull('players_stats.MIN');
                if ($this->statsPerGame_phase == 'regular') {
                    $stats = $stats->whereNull('matches.clash_id');
                } else {
                    $stats = $stats->whereNotNull('matches.clash_id');
                }
                $stats = $stats
                ->orderBy($this->statsPerGame_order, $this->statsPerGame_order_direction)
                ->orderBy('PJ', $this->statsPerGame_order_direction)
                ->orderBy('AVG_MIN', 'desc')
                ->groupBy('team_id')
                ->having('PJ', '>', 1)
                ->get();

        return $stats;
    }

    public function mount($player)
    {
        $this->player = $player;
    }

    public function getMoreTeamPlayers()
    {
        return $players = Player::
            where('team_id', $this->player->team_id)
            ->where('id', '!=', $this->player->id)
            ->orderBy('position', 'asc')
            ->get();
    }

    public function render()
    {
        $moreTeamPlayers = $this->getMoreTeamPlayers();

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

        return view('player.index', [
            'moreTeamPlayers'             => $moreTeamPlayers,
            'statsPerGame'                => $this->getStatsPerGame(),
            'statsPerGame_totals'         => $this->getStatsPerGame_totals(),
            'statsPerGame_team_totals'    => $this->getStatsPerGame_team_totals(),
        ]);
    }
}
