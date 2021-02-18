<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'direct_playoffs_start',
        'direct_playoffs_end',
        'play_in_start',
        'play_in_end',
        'current',
        'slug'
    ];

    public function conferences() {
        return $this->hasMany('App\Models\SeasonConference');
    }

    public function divisions() {
        return $this->hasMany('App\Models\SeasonDivision');
    }

    public function teams() {
        return $this->hasMany('App\Models\SeasonTeam');
    }

    public function scores_headers() {
        return $this->hasMany('App\Models\SeasonScoreHeader');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('seasons.name', 'LIKE', "%{$value}%")
                                ->orWhere('seasons.id', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
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

    protected function setTableOrder($order)
    {
        switch ($order) {
            case 'wavg':
                return $criteria = [
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'wavg_desc':
                return $criteria = [
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'w':
                return $criteria = [
                    "w" => "desc",
                    "wavg" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'w_desc':
                return $criteria = [
                    "w" => "asc",
                    "wavg" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'l':
                return $criteria = [
                    "l" => "desc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'l_desc':
                return $criteria = [
                    "l" => "asc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "team_name" => "asc"
                ];
            case 'streak':
                return $criteria = [
                    "streak" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'streak_desc':
                return $criteria = [
                    "streak" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'last10':
                return $criteria = [
                    "last10_percent" => "desc",
                    "last10_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'last10_desc':
                return $criteria = [
                    "last10_percent" => "asc",
                    "last10_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'home':
                return $criteria = [
                    "home_percent" => "desc",
                    "home_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'home_desc':
                return $criteria = [
                    "home_percent" => "asc",
                    "home_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'road':
                return $criteria = [
                    "road_percent" => "desc",
                    "road_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'road_desc':
                return $criteria = [
                    "road_percent" => "asc",
                    "road_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'ot':
                return $criteria = [
                    "ot_percent" => "desc",
                    "ot_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'ot_desc':
                return $criteria = [
                    "ot_percent" => "asc",
                    "ot_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'conf':
                return $criteria = [
                    "conf_percent" => "desc",
                    "conf_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'conf_desc':
                return $criteria = [
                    "conf_percent" => "asc",
                    "conf_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'div':
                return $criteria = [
                    "div_percent" => "desc",
                    "div_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'div_desc':
                return $criteria = [
                    "div_percent" => "asc",
                    "div_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'name':
                return $criteria = [
                    "team_name" => "asc"
                ];
                break;
            case 'name_desc':
                return $criteria = [
                    "team_name" => "desc"
                ];
                break;
            case 'medium_name':
                return $criteria = [
                    "team_medium_name" => "asc"
                ];
                break;
            case 'medium_name_desc':
                return $criteria = [
                    "team_medium_name" => "desc"
                ];
                break;
        }
    }

    public function get_table_data_team($team_id, $streak)
    {
        $data = [
            "w" => 0,
            "l" => 0,
            "wavg" => 0,
            "conf_w" => 0,
            "conf_l" => 0,
            "conf_percent" => 0,
            "div_w" => 0,
            "div_l" => 0,
            "div_percent" => 0,
            "home_w" => 0,
            "home_l" => 0,
            "home_percent" => 0,
            "road_w" => 0,
            "road_l" => 0,
            "road_percent" => 0,
            "ot_w" => 0,
            "ot_l" => 0,
            "ot_percent" => 0,
            "last10_w" => 0,
            "last10_l" => 0,
            "last10_percent" => 0,
            "streak" => 0,
        ];

        $matches = Match::leftJoin('scores', 'scores.match_id', 'matches.id')
            ->select('matches.*')
            ->with('season')
            ->with('localTeam')
            ->with('visitorTeam')
            ->with('scores')
            ->where('season_id', $this->id)
            ->where(function($q) use ($team_id) {
                $q->where('local_team_id', $team_id)
                    ->orWhere('visitor_team_id', $team_id);
                })
            ->orderBy('scores.created_at', 'desc')
            ->get();

        foreach ($matches as $key => $match) {
            if ($match->played()) {
                $local_score = $match->scores->sum('local_score');
                $visitor_score = $match->scores->sum('visitor_score');
                $same_conf = $match->localTeam->seasonDivision->seasonConference->id == $match->visitorTeam->seasonDivision->seasonConference->id ? true : false;
                $same_div = $match->localTeam->seasonDivision->id == $match->visitorTeam->seasonDivision->id ? true : false;
                $extra_times = $match->extra_times > 0 ? true : false;
                if ($team_id == $match->local_team_id) {
                    if ($local_score > $visitor_score) {
                        $data['w'] += 1;
                        if ($same_conf) { $data['conf_w'] += 1; }
                        if ($same_div) { $data['div_w'] += 1; }
                        if ($extra_times) { $data['ot_w'] += 1; }
                        $data['home_w'] += 1;
                        if ($key < 10) { $data['last10_w'] += 1; }
                    } else {
                        $data['l'] += 1;
                        if ($same_conf) { $data['conf_l'] += 1; }
                        if ($same_div) { $data['div_l'] += 1; }
                        if ($extra_times) { $data['ot_l'] += 1; }
                        $data['home_l'] += 1;
                        if ($key < 10) { $data['last10_l'] += 1; }
                    }
                } else {
                    if ($local_score > $visitor_score) {
                        $data['l'] += 1;
                        if ($same_conf) { $data['conf_l'] += 1; }
                        if ($same_div) { $data['div_l'] += 1; }
                        if ($extra_times) { $data['ot_l'] += 1; }
                        $data['road_l'] += 1;
                        if ($key < 10) { $data['last10_l'] += 1; }
                    } else {
                        $data['w'] += 1;
                        if ($same_conf) { $data['conf_w'] += 1; }
                        if ($same_div) { $data['div_w'] += 1; }
                        if ($extra_times) { $data['ot_w'] += 1; }
                        $data['road_w'] += 1;
                        if ($key < 10) { $data['last10_w'] += 1; }
                    }
                }
            }
        }

        if ($streak) {
            // loop for streak
            $matches = Match::leftJoin('scores', 'scores.match_id', 'matches.id')
                ->select('matches.*')
                ->with('season')
                ->with('localTeam')
                ->with('visitorTeam')
                ->with('scores')
                ->where('season_id', $this->id)
                ->where(function($q) use ($team_id) {
                    $q->where('local_team_id', $team_id)
                        ->orWhere('visitor_team_id', $team_id);
                    })
                ->orderBy('scores.created_at', 'asc')
                ->get();

            foreach ($matches as $key => $match) {
                if ($match->played()) {
                    $local_score = $match->scores->sum('local_score');
                    $visitor_score = $match->scores->sum('visitor_score');
                    if ($team_id == $match->local_team_id) {
                        if ($local_score > $visitor_score) {
                            if ($data['streak'] > 0) {
                                $data['streak'] += 1;
                            } else {
                                $data['streak'] = 1;
                            }
                        } else {
                            if ($data['streak'] < 0) {
                                $data['streak'] -= 1;
                            } else {
                                $data['streak'] = -1;
                            }
                        }
                    } else {
                        if ($local_score > $visitor_score) {
                            if ($data['streak'] < 0) {
                                $data['streak'] -= 1;
                            } else {
                                $data['streak'] = -1;
                            }
                        } else {
                            if ($data['streak'] > 0) {
                                $data['streak'] += 1;
                            } else {
                                $data['streak'] = 1;
                            }
                        }
                    }
                }
            }
        }

        //calculed data
        $matches_played = $data['w'] + $data['l'];
        $data['wavg'] = $matches_played > 0 ? $data['w'] / $matches_played : 0;
        $conf_played = $data['conf_w'] + $data['conf_l'];
        $data['conf_percent'] = $conf_played > 0 ? ($data['conf_w'] / $conf_played) * 100 : 0;
        $div_played = $data['div_w'] + $data['div_l'];
        $data['div_percent'] = $div_played > 0 ? ($data['div_w'] / $div_played) * 100 : 0;
        $ot_played = $data['ot_w'] + $data['ot_l'];
        $data['ot_percent'] = $ot_played > 0 ? ($data['ot_w'] / $ot_played) * 100 : 0;
        $home_played = $data['home_w'] + $data['home_l'];
        $data['home_percent'] = $home_played > 0 ? ($data['home_w'] / $home_played) * 100 : 0;
        $road_played = $data['road_w'] + $data['road_l'];
        $data['road_percent'] = $road_played > 0 ? ($data['road_w'] / $road_played) * 100 : 0;
        $last10_played = $data['last10_w'] + $data['last10_l'];
        $data['last10_percent'] = $last10_played > 0 ? ($data['last10_w'] / $last10_played) * 100 : 0;
        return $data;
    }

    public function get_table_data_team_record($team_id)
    {
        $data = [
            "w" => 0,
            "l" => 0,
        ];

        $matches = Match::leftJoin('scores', 'scores.match_id', 'matches.id')
            ->select('matches.*')
            ->where('season_id', $this->id)
            ->where(function($q) use ($team_id) {
                $q->where('local_team_id', $team_id)
                    ->orWhere('visitor_team_id', $team_id);
                })
            ->orderBy('scores.created_at', 'desc')
            ->get();

        foreach ($matches as $key => $match) {
            if ($match->played()) {
                $local_score = $match->scores->sum('local_score');
                $visitor_score = $match->scores->sum('visitor_score');
                $same_conf = $match->localTeam->seasonDivision->seasonConference->id == $match->visitorTeam->seasonDivision->seasonConference->id ? true : false;
                $same_div = $match->localTeam->seasonDivision->id == $match->visitorTeam->seasonDivision->id ? true : false;
                if ($team_id == $match->local_team_id) {
                    if ($local_score > $visitor_score) {
                        $data['w'] += 1;
                    } else {
                        $data['l'] += 1;
                    }
                } else {
                    if ($local_score > $visitor_score) {
                        $data['l'] += 1;
                    } else {
                        $data['w'] += 1;
                    }
                }
            }
        }

        return $data;
    }

    public function generateTable($type, $order, $conference_id, $division_id, $streak)
    {
        $table_teams = collect();
        switch ($type) {
            case 'general':
                $teams = $this->teams;
                break;
            case 'conference':
                $teams = SeasonTeam::
                    leftJoin('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
                    ->leftJoin('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
                    ->with('team')
                    ->with('seasonDivision')
                    ->select('seasons_teams.*')
                    ->where('seasons_divisions.season_conference_id', $conference_id)
                    ->get();
                break;
            case 'division':
                $teams = SeasonTeam::
                    leftJoin('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
                   ->with('team')
                    ->with('seasonDivision')
                    ->select('seasons_teams.*')
                    ->where('seasons_teams.season_division_id', $division_id)
                    ->get();
                break;
        }
        foreach ($teams as $key => $team) {
            $data = $this->get_table_data_team($team->id, $streak);
            $table_teams->push([
                'team' => $team,
                'team_name' => $team->team->name,
                'team_medium_name' => $team->team->medium_name,
                'team_short_name' => $team->team->short_name,
                'team_img' => $team->team->getImg(),
                'team_with_manager' => $team->team->user ? true : false,
                'team_manager' => $team->team->user ? $team->team->user->name : 'Sin manager',
                'w' => $data['w'],
                'l' => $data['l'],
                'wavg' => $data['wavg'],
                'conf_w' => $data['conf_w'],
                'conf_l' => $data['conf_l'],
                'conf_percent' => $data['conf_percent'],
                'div_w' => $data['div_w'],
                'div_l' => $data['div_l'],
                'div_percent' => $data['div_percent'],
                'home_w' => $data['home_w'],
                'home_l' => $data['home_l'],
                'home_percent' => $data['home_percent'],
                'road_w' => $data['road_w'],
                'road_l' => $data['road_l'],
                'road_percent' => $data['road_percent'],
                'ot_w' => $data['ot_w'],
                'ot_l' => $data['ot_l'],
                'ot_percent' => $data['ot_percent'],
                'last10_w' => $data['last10_w'],
                'last10_l' => $data['last10_l'],
                'last10_percent' => $data['last10_percent'],
                'streak' => $data['streak'],
            ]);
        }

        $criteria = $this->setTableOrder($order);
        $comparer = $this->makeComparer($criteria);
        $sorted = $table_teams->sort($comparer);
        $positions = $sorted->values()->toArray();

        return $positions;
    }

    public function top_player($season_team_id)
    {
        return $top = PlayerStat::
            select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('SUM(PTS + REB + AST) / COUNT(player_id) as AVG_TOTAL')
            )
            ->with('season', 'player', 'seasonTeam')
            ->where('season_team_id', $season_team_id)
            ->orderBy('AVG_TOTAL', 'desc')
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('AVG_AST', 'desc')
            ->groupBy('player_id')
            ->first();
    }

    public function top_season_mvp()
    {
        return $top = PlayerStat::
            select('player_id', 'season_team_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('SUM(PTS + REB + AST) / COUNT(player_id) as AVG_TOTAL')
            )
            ->with('season', 'player', 'seasonTeam')
            ->where('season_id', $this->id)
            ->orderBy('AVG_TOTAL', 'desc')
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('AVG_AST', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->take(3)->get();
    }

    public function top_season_pts()
    {
        return $top = PlayerStat::
            select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('SUM(PTS) as SUM_PTS'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->with('season', 'player', 'seasonTeam')
            ->where('season_id', $this->id)
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('SUM_PTS', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();
    }

    public function top_season_reb()
    {
        return $top = PlayerStat::
            select('player_id',
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('SUM(REB) as SUM_REB'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->with('season', 'player', 'seasonTeam')
            ->where('season_id', $this->id)
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('SUM_REB', 'desc')
            ->groupBy('player_id')
            ->take(3)->get();
    }

    public function top_season_ast()
    {
        return $top = PlayerStat::
            select('player_id',
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('SUM(AST) as SUM_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->with('season', 'player', 'seasonTeam')
            ->where('season_id', $this->id)
            ->orderBy('AVG_AST', 'desc')
            ->orderBy('SUM_AST', 'desc')
            ->groupBy('player_id',)
            ->take(3)->get();
    }
}