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

    private function makeComparer($criteria)
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

    public function generateGeneralTable()
    {
        $table_teams = collect();
        $teams = $this->teams;
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
                'div_w' => $data['div_w'],
                'div_l' => $data['div_l'],
                'home_w' => $data['home_w'],
                'home_l' => $data['home_l'],
                'road_w' => $data['road_w'],
                'road_l' => $data['road_l'],
                //ot
                'last10_w' => $data['last10_w'],
                'last10_l' => $data['last10_l'],
                'streak' => $data['streak'],
            ]);
        }

        $criteria = [
            "wavg" => "desc",
            "w" => "desc",
            "l" => "asc",
            "team_name" => "asc"
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $table_teams->sort($comparer);
        $positions = $sorted->values()->toArray();

        return $positions;
    }

    public function generateConferencesTable($conference_id)
    {
        $table_teams = collect();
        $teams = SeasonTeam::
            leftJoin('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
            ->leftJoin('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
            ->select('seasons_teams.*')
            ->where('seasons_divisions.season_conference_id', $conference_id)
            ->get();
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
                'div_w' => $data['div_w'],
                'div_l' => $data['div_l'],
                'home_w' => $data['home_w'],
                'home_l' => $data['home_l'],
                'road_w' => $data['road_w'],
                'road_l' => $data['road_l'],
                //ot
                'last10_w' => $data['last10_w'],
                'last10_l' => $data['last10_l'],
                'streak' => $data['streak'],
            ]);
        }

        $criteria = [
            "wavg" => "desc",
            "w" => "desc",
            "l" => "asc",
            "team_name" => "asc"
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $table_teams->sort($comparer);
        $positions = $sorted->values()->toArray();

        return $positions;
    }

    public function generateDivisionsTable($division_id)
    {
        $table_teams = collect();
        $teams = SeasonTeam::
            leftJoin('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_division_id', $division_id)
            ->get();
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
                'div_w' => $data['div_w'],
                'div_l' => $data['div_l'],
                'home_w' => $data['home_w'],
                'home_l' => $data['home_l'],
                'road_w' => $data['road_w'],
                'road_l' => $data['road_l'],
                //ot
                'last10_w' => $data['last10_w'],
                'last10_l' => $data['last10_l'],
                'streak' => $data['streak'],
            ]);
        }

        $criteria = [
            "wavg" => "desc",
            "w" => "desc",
            "l" => "asc",
            "team_name" => "asc"
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $table_teams->sort($comparer);
        $positions = $sorted->values()->toArray();

        return $positions;
    }

    public function get_table_data_team($team_id)
    {
        $data = [
            "w" => 0,
            "l" => 0,
            "wavg" => 0,
            "conf_w" => 0,
            "conf_l" => 0,
            "div_w" => 0,
            "div_l" => 0,
            "home_w" => 0,
            "home_l" => 0,
            "road_w" => 0,
            "road_l" => 0,
            // ot
            "last10_w" => 0,
            "last10_l" => 0,
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
        $matches_played = $data['w'] + $data['l'];
        $data['wavg'] = $matches_played > 0 ? $data['w'] / $matches_played : 0;
        return $data;
    }
}
