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
                    "last10_diff" => "desc",
                    "last10_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'last10_desc':
                return $criteria = [
                    "last10_diff" => "asc",
                    "last10_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'home':
                return $criteria = [
                    "home_diff" => "desc",
                    "home_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'home_desc':
                return $criteria = [
                    "home_diff" => "asc",
                    "home_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'road':
                return $criteria = [
                    "road_diff" => "desc",
                    "road_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'road_desc':
                return $criteria = [
                    "road_diff" => "asc",
                    "road_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'conf':
                return $criteria = [
                    "conf_diff" => "desc",
                    "conf_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'conf_desc':
                return $criteria = [
                    "conf_diff" => "asc",
                    "conf_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
            case 'div':
                return $criteria = [
                    "div_diff" => "desc",
                    "div_w" => "desc",
                    "wavg" => "desc",
                    "w" => "desc",
                    "l" => "asc",
                    "team_name" => "asc"
                ];
                break;
            case 'div_desc':
                return $criteria = [
                    "div_diff" => "asc",
                    "div_w" => "asc",
                    "wavg" => "asc",
                    "w" => "asc",
                    "l" => "desc",
                    "team_name" => "asc"
                ];
                break;
        }
    }

    protected function get_table_data_team($team_id)
    {
        $data = [
            "w" => 0,
            "l" => 0,
            "wavg" => 0,
            "conf_w" => 0,
            "conf_l" => 0,
            "conf_diff" => 0,
            "div_w" => 0,
            "div_l" => 0,
            "div_diff" => 0,
            "home_w" => 0,
            "home_l" => 0,
            "home_diff" => 0,
            "road_w" => 0,
            "road_l" => 0,
            "road_diff" => 0,
            // ot
            "last10_w" => 0,
            "last10_l" => 0,
            "last10_diff" => 0,
            "streak" => 0,
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
                        if ($same_conf) { $data['conf_w'] += 1; }
                        if ($same_div) { $data['div_w'] += 1; }
                        $data['home_w'] += 1;
                        if ($key < 10) { $data['last10_w'] += 1; }
                    } else {
                        $data['l'] += 1;
                        if ($same_conf) { $data['conf_l'] += 1; }
                        if ($same_div) { $data['div_l'] += 1; }
                        $data['home_l'] += 1;
                        if ($key < 10) { $data['last10_l'] += 1; }
                    }
                } else {
                    if ($local_score > $visitor_score) {
                        $data['l'] += 1;
                        if ($same_conf) { $data['conf_l'] += 1; }
                        if ($same_div) { $data['div_l'] += 1; }
                        $data['road_l'] += 1;
                        if ($key < 10) { $data['last10_l'] += 1; }
                    } else {
                        $data['w'] += 1;
                        if ($same_conf) { $data['conf_w'] += 1; }
                        if ($same_div) { $data['div_w'] += 1; }
                        $data['road_w'] += 1;
                        if ($key < 10) { $data['last10_w'] += 1; }
                    }
                }
            }
        }

        // loop for streak
        $matches = Match::leftJoin('scores', 'scores.match_id', 'matches.id')
            ->select('matches.*')
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
                $same_conf = $match->localTeam->seasonDivision->seasonConference->id == $match->visitorTeam->seasonDivision->seasonConference->id ? true : false;
                $same_div = $match->localTeam->seasonDivision->id == $match->visitorTeam->seasonDivision->id ? true : false;
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

        //calculed data
        $matches_played = $data['w'] + $data['l'];
        $data['wavg'] = $matches_played > 0 ? $data['w'] / $matches_played : 0;
        $data['conf_diff'] = $data['conf_w'] - $data['conf_l'];
        $data['div_diff'] = $data['div_w'] - $data['div_l'];
        $data['home_diff'] = $data['home_w'] - $data['home_l'];
        $data['road_diff'] = $data['road_w'] - $data['road_l'];
        $data['last10_diff'] = $data['last10_w'] - $data['last10_l'];

        return $data;
    }

    public function generateTable($type, $order, $conference_id, $division_id)
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
                    ->select('seasons_teams.*')
                    ->where('seasons_divisions.season_conference_id', $conference_id)
                    ->get();
                break;
            case 'division':
                $teams = SeasonTeam::
                    leftJoin('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
                    ->select('seasons_teams.*')
                    ->where('seasons_teams.season_division_id', $division_id)
                    ->get();
                break;
        }
        foreach ($teams as $key => $team) {
            $data = $this->get_table_data_team($team->id);
            $table_teams->push([
                'team' => $team,
                'team_name' => $team->team->medium_name,
                'w' => $data['w'],
                'l' => $data['l'],
                'wavg' => $data['wavg'],
                'conf_w' => $data['conf_w'],
                'conf_l' => $data['conf_l'],
                'conf_diff' => $data['conf_diff'],
                'div_w' => $data['div_w'],
                'div_l' => $data['div_l'],
                'div_diff' => $data['div_diff'],
                'home_w' => $data['home_w'],
                'home_l' => $data['home_l'],
                'home_diff' => $data['home_diff'],
                'road_w' => $data['road_w'],
                'road_l' => $data['road_l'],
                'road_diff' => $data['road_diff'],
                //ot
                'last10_w' => $data['last10_w'],
                'last10_l' => $data['last10_l'],
                'last10_diff' => $data['last10_diff'],
                'streak' => $data['streak'],
            ]);
        }

        $criteria = $this->setTableOrder($order);
        $comparer = $this->makeComparer($criteria);
        $sorted = $table_teams->sort($comparer);
        $positions = $sorted->values()->toArray();

        return $positions;
    }
}
