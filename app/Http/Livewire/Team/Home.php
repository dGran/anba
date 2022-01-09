<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;
use App\Models\SeasonTeam;

class Home extends Component
{
    public $team;

    public $season_team;
    public $current_season;
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

    public function getTotalPlayersPosition($pos)
    {
        return $total = Player::where('team_id', $this->season_team->team_id)->where('position', $pos)->count();
    }

	public function mount($team)
	{
		$this->team = $team;

        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
        }
	}

   public function getHeadline()
    {
        $PlayersStats = PlayerStat::with('player')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->select('player_id',
                    \DB::raw("CONCAT(LEFT(players.name, 1), '. ', RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name))) AS player_name"),
                    \DB::raw('(CASE
                                WHEN players.position = "pg" THEN 1
                                WHEN players.position = "sg" THEN 2
                                WHEN players.position = "sf" THEN 3
                                WHEN players.position = "pf" THEN 4
                                WHEN players.position = "c" THEN 5
                                END) AS POS'),
                    \DB::raw('COUNT(player_id) as PJ'),
                    \DB::raw('SUM(headline) as PT'),
                );
        $PlayersStats = $PlayersStats->where('players_stats.season_id', $this->current_season->id);
        $PlayersStats = $PlayersStats->where('players_stats.season_team_id', $this->season_team->id);
        $PlayersStats = $PlayersStats
            ->having('PJ', '>', 1)
            ->orderBy('PT', 'desc')
            ->orderBy('PJ', 'desc')
            ->groupBy('player_id')
            ->take(5)
            ->get();

        return $PlayersStats;
    }

    public function render()
    {

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
                    $prior_team = $more_teams[$index-1]->team->slug;
                } else {
                    $prior_team = $more_teams[$more_teams->count()-1]->team->slug;
                }
                if ($index+1 < $more_teams->count()) {
                    $next_team = $more_teams[$index+1]->team->slug;
                } else {
                    $next_team = $more_teams[0]->team->slug;
                }
            }
        }

        $team_seasons = SeasonTeam::
            join('seasons', 'seasons.id', 'seasons_teams.season_id')
            ->select('seasons_teams.*', 'seasons.name as season_name')
            ->where('team_id', $season_team->team_id)
            ->orderBy('season_name')
            ->get();

        $team_all_seasons_matches = $this->season_team->team->get_all_seasons_team_matches()->count();
        $team_all_seasons_record = $this->season_team->team->get_all_seasons_team_record();
        $team_all_seasons_record_percent = ($team_all_seasons_record['w'] / $team_all_seasons_matches) * 100;

        return view('team.home.index', [
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team,
            'total_pg'          => $this->getTotalPlayersPosition('pg'),
            'total_sg'          => $this->getTotalPlayersPosition('sg'),
            'total_sf'          => $this->getTotalPlayersPosition('sf'),
            'total_pf'          => $this->getTotalPlayersPosition('pf'),
            'total_c'           => $this->getTotalPlayersPosition('c'),
            'headline'          => $this->getHeadline(),
            'team_seasons'       => $team_seasons,
            'team_all_seasons_record'   => $team_all_seasons_record,
            'team_all_seasons_record_percent'   => $team_all_seasons_record_percent
        ]);
    }
}
