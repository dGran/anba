<?php

namespace App\Http\Livewire\Stats;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Season;
use App\Models\PlayerStat;
use App\Models\TeamStat;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\SeasonTeam;
use App\Models\SeasonDivision;
use App\Models\SeasonConference;

class Teams extends Component
{
    public $team_stats;
    public $criteria;

    public $advanced_filters = false;

    public $current_season;
    public $season;
    public $phase = "regular";
    public $mode = "per_game";
    public $name = null;

    public $order = "PER_W";
    public $order_direction = "desc";

    // queryString
    protected $queryString = [
        'season',
        'phase' => ['except' => 'regular'],
        'mode' => ['except' => 'per_game'],
        'name' => ['except' => ''],
        'order',
        'order_direction',
    ];

    public function reset_all_filters()
    {
        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season = $season->slug;
        }
        $this->phase = "regular";
        $this->mode = "per_game";

        $this->name = null;
        $this->change_mode();
    }

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
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
            // $order = $pre_order . $rest_order;
            $this->change_order_mode($rest_order);
        } else {
            $this->change_order_mode($this->order);
        }
    }

    public function setOrder($order)
    {
        if ($order != 'team_name' && $order != 'PJ' && $order != 'W' && $order != 'L' && $order != 'PER_W' && $order != 'PER_FG' && $order != 'PER_TP' && $order != 'PER_FT') {
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
            if ($this->order != 'team_name') {
                $this->order_direction = "desc";
            } else {
                $this->order_direction = "asc";
            }
        }

        $this->criteria = [
            $this->order => $this->order_direction,
        ];
    }

    public function change_order_mode($order)
    {
        if ($order != 'team_name' && $order != 'PJ' && $order != 'W' && $order != 'L' && $order != 'PER_W' && $order != 'PER_FG' && $order != 'PER_TP' && $order != 'PER_FT') {
            if ($this->mode == "per_game") {
                $this->order = 'AVG_' . $order;
            } else {
                $this->order = 'SUM_' . $order;
            }
        }
    }

    public function set_phase($phase)
    {
        $this->phase = $phase;
    }

    public function getTeamsStats()
    {
        $teams_stats = Collection::make();

        $search = $this->name;
        $season_teams = SeasonTeam::
            join('teams', 'teams.id', 'seasons_teams.team_id')
            ->where('season_id', $this->current_season->id)
            ->select('seasons_teams.id');
            if ($search != null) {
                $season_teams = $season_teams->where(function($q) use ($search) {
                    $q->where('teams.name', 'LIKE', "%{$search}%")
                        ->orWhere('teams.medium_name', 'LIKE', "%{$search}%")
                        ->orWhere('teams.short_name', 'LIKE', "%{$search}%")
                        ->orWhere('teams.id', 'LIKE', "%{$search}%");
                });
            }
            $season_teams = $season_teams->get();

        foreach ($season_teams as $season_team) {
            $seasonTeamId = $season_team->id;

            // get team_stats data
            $teamStats = MatchModel::
                join('teams_stats', 'teams_stats.match_id', 'matches.id')
                ->join('scores', 'scores.match_id', 'matches.id')
                ->join('seasons_teams', 'seasons_teams.id', 'teams_stats.season_team_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->where('teams_stats.season_team_id', $seasonTeamId)
                ->where('matches.played', 1)
                ->where('matches.teamStats_state', 'success')
                ->where('matches.playerStats_state', 'success')
                ->select('matches.season_id', 'teams_stats.season_team_id',
                    \DB::raw('teams.name as team_name'),
                    \DB::raw('teams.short_name as team_short_name'),
                    \DB::raw('teams.medium_name as team_medium_name'),
                    \DB::raw('teams.slug as team_slug'),
                    \DB::raw('SUM(counterattack) as SUM_counterattack'),
                    \DB::raw('AVG(counterattack) as AVG_counterattack'),
                    \DB::raw('SUM(zone) as SUM_zone'),
                    \DB::raw('AVG(zone) as AVG_zone'),
                    \DB::raw('SUM(second_oportunity) as SUM_second_oportunity'),
                    \DB::raw('AVG(second_oportunity) as AVG_second_oportunity'),
                    \DB::raw('SUM(substitute) as SUM_substitute'),
                    \DB::raw('AVG(substitute) as AVG_substitute'),
                    \DB::raw('SUM(advantage) as SUM_advantage'),
                    \DB::raw('AVG(advantage) as AVG_advantage'),
                    \DB::raw('SUM(AST) as SUM_AST'),
                    \DB::raw('AVG(AST) as AVG_AST'),
                    \DB::raw('SUM(DRB) as SUM_DRB'),
                    \DB::raw('AVG(DRB) as AVG_DRB'),
                    \DB::raw('SUM(ORB) as SUM_ORB'),
                    \DB::raw('AVG(ORB) as AVG_ORB'),
                    \DB::raw('SUM(DRB) + SUM(ORB) as SUM_REB'),
                    \DB::raw('AVG(DRB) + AVG(ORB) as AVG_REB'),
                    \DB::raw('SUM(STL) as SUM_STL'),
                    \DB::raw('AVG(STL) as AVG_STL'),
                    \DB::raw('SUM(BLK) as SUM_BLK'),
                    \DB::raw('AVG(BLK) as AVG_BLK'),
                    \DB::raw('SUM(LOS) as SUM_LOS'),
                    \DB::raw('AVG(LOS) as AVG_LOS'),
                    \DB::raw('SUM(PF) as SUM_PF'),
                    \DB::raw('AVG(PF) as AVG_PF'),
                    \DB::raw('COUNT(season_team_id) as PJ'),
                );
                if ($this->phase == "regular") {
                    $teamStats = $teamStats->whereNull('matches.clash_id');
                } else {
                    $teamStats = $teamStats->whereNotNull('matches.clash_id');
                }
                $teamStats = $teamStats->first();

            // get players_stats data
            $playersStats = MatchModel::
                join('players_stats', 'players_stats.match_id', 'matches.id')
                ->where('players_stats.season_team_id', $seasonTeamId)
                ->where('matches.played', 1)
                ->where('matches.teamStats_state', 'success')
                ->where('matches.playerStats_state', 'success')
                ->select('matches.season_id', 'players_stats.season_team_id',
                    \DB::raw('SUM(PTS) as SUM_PTS'),
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                );
                if ($this->phase == "regular") {
                    $playersStats = $playersStats->whereNull('matches.clash_id');
                } else {
                    $playersStats = $playersStats->whereNotNull('matches.clash_id');
                }
                $playersStats = $playersStats->first();

            // get team matches and results
            $team_results = MatchModel::
                join('scores', 'scores.match_id', 'matches.id')
                ->where('matches.played', 1)
                ->where('matches.teamStats_state', 'success')
                ->where('matches.playerStats_state', 'success')
                ->where(function($q) use ($seasonTeamId) {
                    $q->where('matches.local_team_id', $seasonTeamId)
                      ->orWhere('matches.visitor_team_id', $seasonTeamId);
                })
                ->select('matches.local_team_id', 'matches.visitor_team_id', 'scores.local_score', 'scores.visitor_score');
                if ($this->phase == "regular") {
                    $team_results = $team_results->whereNull('matches.clash_id');
                } else {
                    $team_results = $team_results->whereNotNull('matches.clash_id');
                }
                $team_results = $team_results->get();

            // fill team_stats collection
            if ($teamStats->PJ) {
                $team_stats['season_team_id'] = $teamStats->season_team_id;
                $team_stats['team_name'] = $teamStats->team_name;
                $team_stats['team_short_name'] = $teamStats->team_short_name;
                $team_stats['team_medium_name'] = $teamStats->team_medium_name;
                $team_stats['team_slug'] = $teamStats->team_slug;
                //calculate results
                $wins = 0;
                $losses = 0;
                $moreLess = 0;
                foreach ($team_results as $result) {
                    if ($seasonTeamId == $result->local_team_id) {
                        $moreLess += $result->local_score;
                        $moreLess -= $result->visitor_score;
                        if ($result->local_score > $result->visitor_score) {
                            $wins++;
                        } else {
                            $losses++;
                        }
                    } else {
                        $moreLess -= $result->local_score;
                        $moreLess += $result->visitor_score;
                        if ($result->local_score < $result->visitor_score) {
                            $wins++;
                        } else {
                            $losses++;
                        }
                    }
                }
                $team_stats['PJ'] = $teamStats->PJ;
                $team_stats['W'] = $wins;
                $team_stats['L'] = $losses;
                $team_stats['PER_W'] = $wins / $teamStats->PJ;
                $team_stats['SUM_PTS'] = $playersStats->SUM_PTS;
                $team_stats['AVG_PTS'] = $playersStats->SUM_PTS / $teamStats->PJ;
                $team_stats['SUM_FGM'] = $playersStats->SUM_FGM;
                $team_stats['AVG_FGM'] = $playersStats->SUM_FGM / $teamStats->PJ;
                $team_stats['SUM_FGA'] = $playersStats->SUM_FGA;
                $team_stats['AVG_FGA'] = $playersStats->SUM_FGA / $teamStats->PJ;
                $team_stats['PER_FG'] = $playersStats->PER_FG;
                $team_stats['SUM_TPM'] = $playersStats->SUM_TPM;
                $team_stats['AVG_TPM'] = $playersStats->SUM_TPM / $teamStats->PJ;
                $team_stats['SUM_TPA'] = $playersStats->SUM_TPA;
                $team_stats['AVG_TPA'] = $playersStats->SUM_TPA / $teamStats->PJ;
                $team_stats['PER_TP'] = $playersStats->PER_TP;
                $team_stats['SUM_FTM'] = $playersStats->SUM_FTM;
                $team_stats['AVG_FTM'] = $playersStats->SUM_FTM / $teamStats->PJ;
                $team_stats['SUM_FTA'] = $playersStats->SUM_FTA;
                $team_stats['AVG_FTA'] = $playersStats->SUM_FTA / $teamStats->PJ;
                $team_stats['PER_FT'] = $playersStats->PER_FT;
                $team_stats['SUM_REB'] = $teamStats->SUM_REB;
                $team_stats['AVG_REB'] = $teamStats->AVG_REB;
                $team_stats['SUM_ORB'] = $teamStats->SUM_ORB;
                $team_stats['AVG_ORB'] = $teamStats->AVG_ORB;
                $team_stats['SUM_DRB'] = $teamStats->SUM_DRB;
                $team_stats['AVG_DRB'] = $teamStats->AVG_DRB;
                $team_stats['SUM_AST'] = $teamStats->SUM_AST;
                $team_stats['AVG_AST'] = $teamStats->AVG_AST;
                $team_stats['SUM_STL'] = $teamStats->SUM_STL;
                $team_stats['AVG_STL'] = $teamStats->AVG_STL;
                $team_stats['SUM_BLK'] = $teamStats->SUM_BLK;
                $team_stats['AVG_BLK'] = $teamStats->AVG_BLK;
                $team_stats['SUM_LOS'] = $teamStats->SUM_LOS;
                $team_stats['AVG_LOS'] = $teamStats->AVG_LOS;
                $team_stats['SUM_PF'] = $teamStats->SUM_PF;
                $team_stats['AVG_PF'] = $teamStats->AVG_PF;
                $team_stats['SUM_ML'] = $moreLess;
                $team_stats['AVG_ML'] = $moreLess / $teamStats->PJ;
                $team_stats['SUM_counterattack'] = $teamStats->SUM_counterattack;
                $team_stats['AVG_counterattack'] = $teamStats->AVG_counterattack;
                $team_stats['SUM_zone'] = $teamStats->SUM_zone;
                $team_stats['AVG_zone'] = $teamStats->AVG_zone;
                $team_stats['SUM_second_oportunity'] = $teamStats->SUM_second_oportunity;
                $team_stats['AVG_second_oportunity'] = $teamStats->AVG_second_oportunity;
                $team_stats['SUM_substitute'] = $teamStats->SUM_substitute;
                $team_stats['AVG_substitute'] = $teamStats->AVG_substitute;
                $team_stats['SUM_advantage'] = $teamStats->SUM_advantage;
                $team_stats['AVG_advantage'] = $teamStats->AVG_advantage;

                $teams_stats->push($team_stats);
            }

        }

        $comparer = $this->makeComparer($this->criteria);
        $sorted = $teams_stats->sort($comparer);
        $result = $sorted->values()->toArray();

        return $result;
    }

    public function cancel_season_filter()
    {
        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season = $season->slug;
        }
    }

    public function mount()
    {
        // if ($season = Season::where('current', 1)->first()) {
        //     $this->season = $season;
        // }
        $this->criteria = [
            "PER_W" => "desc",
            // "player_pos_ordered" => "asc",
        ];
    }

    public function render()
    {
        if ($this->season == null) {
            if ($season = Season::where('current', 1)->first()) {
                $this->current_season = $season;
                $this->season = $season->slug;
            }
        } else {
            $season = Season::where('slug', $this->season)->first();
            $this->current_season = $season;
            $this->season = $season->slug;
        }

        $seasons = Season::orderBy('name', 'desc')->get();
        $teams_stats = $this->getTeamsStats();

        return view('stats.teams.index', [
            'teams_stats'       => $teams_stats,
            'seasons'           => $seasons,
        ]);
    }

    protected function makeComparer($criteria)
    {
        $comparer = function ($first, $second) use ($criteria) {
            foreach ($criteria as $key => $orderType) {
                // normalize sort direction
                $orderType = strtolower($orderType);
                if ($first[$key] < $second[$key]) {
                    return $orderType === "asc" ? -1 : 1;
                } else if ($first[$key] > $second[$key]) {
                    return $orderType === "asc" ? 1 : -1;
                }
            }
            // all elements were equal
            return 0;
        };
        return $comparer;
    }
}
