<?php

namespace App\Http\Livewire\Stats;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Season;
use App\Models\PlayerStat;
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
        $season_teams = SeasonTeam::where('season_id', $this->current_season->id)->get();
        foreach ($season_teams as $season_team) {
            $teamStats = PlayerStat::with('player', 'seasonTeam.team', 'match.scores')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('scores', 'scores.match_id', 'matches.id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
                ->join('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->select('season_team_id', 'players_stats.match_id',
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
                    \DB::raw('SUM(REB) as SUM_REB'),
                    \DB::raw('SUM(ORB) as SUM_ORB'),
                    \DB::raw('SUM(REB) - SUM(ORB)  as SUM_DRB'),
                    \DB::raw('SUM(AST) as SUM_AST'),
                    \DB::raw('SUM(STL) as SUM_STL'),
                    \DB::raw('SUM(BLK) as SUM_BLK'),
                    \DB::raw('SUM(LOS) as SUM_LOS'),
                    \DB::raw('SUM(PF) as SUM_PF'),
                    \DB::raw('SUM(ML) as SUM_ML'),
                );

                if ($this->phase == "regular") {
                    $teamStats = $teamStats->whereNull('matches.clash_id');
                } else {
                    $teamStats = $teamStats->whereNotNull('matches.clash_id');
                }

                if ($this->name != null) {
                    $teamStats = $teamStats->where('teams.name', 'LIKE', "%$this->name%");
                }
                $teamStats = $teamStats
                    ->where('season_team_id', $season_team->id)
                    ->where('matches.played', 1)
                    ->where('matches.teamStats_state', 'success')
                    ->where('matches.playerStats_state', 'success')
                    // ->having('PJ', '>', $this->filter_PJ)
                    // ->orderBy($this->order, $this->order_direction)
                    ->groupBy('players_stats.match_id')
                    ->get();

                foreach ($teamStats as $ts) {
                    $team_stats['season_team_id'] = $ts->season_team_id;
                    $team_stats['team_name'] = $ts->seasonTeam->team->name;
                    $team_stats['team_medium_name'] = $ts->seasonTeam->team->medium_name;
                    $team_stats['team_short_name'] = $ts->seasonTeam->team->short_name;
                    $team_stats['team_slug'] = $ts->seasonTeam->team->slug;
                    $team_stats['match_id'] = $ts->match->id;
                    //calculate winner
                    $local = 0;
                    $visitor = 0;
                    foreach ($ts->match->scores as $score) {
                        $local += $score->local_score;
                        $visitor += $score->visitor_score;
                    }
                    $winner = $local > $visitor ? $ts->match->local_team_id : $ts->match->visitor_team_id ;
                    if ($winner == $ts->season_team_id) {
                        $team_stats['result'] = 'W';
                    } else {
                        $team_stats['result'] = 'L';
                    }
                    $team_stats['PTS'] = $ts->SUM_PTS;
                    $team_stats['FGM'] = $ts->SUM_FGM;
                    $team_stats['FGA'] = $ts->SUM_FGA;
                    $team_stats['PER_FG'] = $ts->PER_FG;
                    $team_stats['TPM'] = $ts->SUM_TPM;
                    $team_stats['TPA'] = $ts->SUM_TPA;
                    $team_stats['PER_TP'] = $ts->PER_TP;
                    $team_stats['FTM'] = $ts->SUM_FTM;
                    $team_stats['FTA'] = $ts->SUM_FTA;
                    $team_stats['PER_FT'] = $ts->PER_FT;
                    $team_stats['REB'] = $ts->SUM_REB;
                    $team_stats['ORB'] = $ts->SUM_ORB;
                    $team_stats['DRB'] = $ts->SUM_DRB;
                    $team_stats['AST'] = $ts->SUM_AST;
                    $team_stats['STL'] = $ts->SUM_STL;
                    $team_stats['BLK'] = $ts->SUM_BLK;
                    $team_stats['LOS'] = $ts->SUM_LOS;
                    $team_stats['PF'] = $ts->SUM_PF;
                    $team_stats['ML'] = $ts->SUM_ML;

                    $teams_stats->push($team_stats);
                }
        }
        $groups = $teams_stats->groupBy('season_team_id');

        $groupwithcount = $groups->mapWithKeys(function ($group, $key) {
            return [
                $key =>
                    [
                        'season_team_id' => $key,
                        'team_name' => $group->first()['team_name'],
                        'team_medium_name' => $group->first()['team_medium_name'],
                        'team_short_name' => $group->first()['team_short_name'],
                        'team_slug' => $group->first()['team_slug'],
                        'PJ' => $group->COUNT('season_team_id'),
                        'W' => $group->WHERE('result', 'W')->count(),
                        'L' => $group->WHERE('result', 'L')->count(),
                        'PER_W' => $group->WHERE('result', 'W')->count() / $group->COUNT('season_team_id'),
                        'AVG_PTS' => $group->AVG('PTS'),
                        'SUM_PTS' => $group->SUM('PTS'),
                        'AVG_FGM' => $group->AVG('FGM'),
                        'SUM_FGM' => $group->SUM('FGM'),
                        'AVG_FGA' => $group->AVG('FGA'),
                        'SUM_FGA' => $group->SUM('FGA'),
                        'PER_FG' => $group->AVG('PER_FG'),
                        'AVG_TPM' => $group->AVG('TPM'),
                        'SUM_TPM' => $group->SUM('TPM'),
                        'AVG_TPA' => $group->AVG('TPA'),
                        'SUM_TPA' => $group->SUM('TPA'),
                        'PER_TP' => $group->AVG('PER_TP'),
                        'AVG_FTM' => $group->AVG('FTM'),
                        'SUM_FTM' => $group->SUM('FTM'),
                        'AVG_FTA' => $group->AVG('FTA'),
                        'SUM_FTA' => $group->SUM('FTA'),
                        'PER_FT' => $group->AVG('PER_FT'),
                        'AVG_REB' => $group->AVG('REB'),
                        'SUM_REB' => $group->SUM('REB'),
                        'AVG_ORB' => $group->AVG('ORB'),
                        'SUM_ORB' => $group->SUM('ORB'),
                        'AVG_DRB' => $group->AVG('DRB'),
                        'SUM_DRB' => $group->SUM('DRB'),
                        'AVG_AST' => $group->AVG('AST'),
                        'SUM_AST' => $group->SUM('AST'),
                        'AVG_STL' => $group->AVG('STL'),
                        'SUM_STL' => $group->SUM('STL'),
                        'AVG_BLK' => $group->AVG('BLK'),
                        'SUM_BLK' => $group->SUM('BLK'),
                        'AVG_LOS' => $group->AVG('LOS'),
                        'SUM_LOS' => $group->SUM('LOS'),
                        'AVG_PF' => $group->AVG('PF'),
                        'SUM_PF' => $group->SUM('PF'),
                        'AVG_ML' => $group->AVG('ML'),
                        'SUM_ML' => $group->SUM('ML'),
                    ]
            ];
        });

        $comparer = $this->makeComparer($this->criteria);
        $sorted = $groupwithcount->sort($comparer);
        $teams_stats = $sorted->values()->toArray();

        return $teams_stats;
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
