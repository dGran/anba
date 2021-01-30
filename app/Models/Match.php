<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'local_team_id',
        'local_manager_id',
        'visitor_team_id',
        'visitor_manager_id',
        'stadium'
    ];

    public function localTeam()
    {
        return $this->belongsTo('App\Models\SeasonTeam', 'local_team_id', 'id');
    }

    public function visitorTeam()
    {
        return $this->belongsTo('App\Models\SeasonTeam', 'visitor_team_id', 'id');
    }

    public function localManager()
    {
        return $this->belongsTo('App\Models\User', 'local_manager_id', 'id');
    }

    public function visitorManager()
    {
        return $this->belongsTo('App\Models\User', 'visitor_manager_id', 'id');
    }

    public function scores()
    {
        return $this->hasMany('App\Models\Score');
    }

    public function poll()
    {
        return $this->hasOne('App\Models\MatchPoll');
    }

    public function playerStats()
    {
        return $this->hasMany('App\Models\PlayerStat');
    }

    public function scopeSeason($query, $value)
    {
        if ($value != 'all') {
            $season = Season::where('slug', $value)->first();
            return $query->where('matches.season_id', '=', $season->id);
        }
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('matches.id', 'LIKE', "%{$value}%")
                                ->orWhere('matches.stadium', 'LIKE', "%{$value}%")
                                ->orWhere('teams.name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.short_name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.medium_name', 'LIKE', "%{$value}%")
                                ->orWhere('users.name', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeTeam($query, $value)
    {
        if ($value != 'all') {
            return $query->where(function($q) use ($value) {
                            $q->where('matches.local_team_id', '=', $value)
                                ->orWhere('matches.visitor_team_id', '=', $value);
                            });
        }
    }

    public function scopeUser($query, $value)
    {
        if ($value != 'all') {
            return $query->where(function($q) use ($value) {
                            $q->where('matches.local_manager_id', '=', $value)
                                ->orWhere('matches.visitor_manager_id', '=', $value);
                            });
        }
    }

    public function scopeHidePlayed($query, $value)
    {
        if ($value) {
            return $query->where(function($q) {
                            $q->whereNull('scores.local_score')
                                ->whereNull('scores.visitor_score');
                            });
        }
    }

    public function getName()
    {
        return $this->localTeam->team->medium_name . ' vs ' . $this->visitorTeam->team->medium_name;
    }

    public function getFullName()
    {
        return $this->localTeam->team->medium_name . ' vs ' . $this->visitorTeam->team->medium_name;
    }

    public function getshortName()
    {
        return $this->localTeam->team->short_name . ' vs ' . $this->visitorTeam->team->short_name;
    }

    public function score()
    {
        if ($this->played()) {
            $local = 0;
            $visitor = 0;
            foreach ($this->scores as $score) {
                $local += $score->local_score;
                $visitor += $score->visitor_score;
            }
            return $local . ' - ' . $visitor;
        } else {
            return '-';
        }
    }

    public function localScore()
    {
        if ($this->played()) {
            $local = 0;
            foreach ($this->scores as $score) {
                $local += $score->local_score;
            }
            return $local;
        } else {
            return '-';
        }
    }

    public function visitorScore()
    {
        if ($this->played()) {
            $visitor = 0;
            foreach ($this->scores as $score) {
                $visitor += $score->visitor_score;
            }
            return $visitor;
        } else {
            return '-';
        }
    }

    public function winner()
    {
        if ($this->played()) {
            $local = 0;
            $visitor = 0;
            foreach ($this->scores as $score) {
                $local += $score->local_score;
                $visitor += $score->visitor_score;
            }
            if ($local > $visitor) {
                return $this->localTeam;
            } else {
                return $this->visitorTeam;
            }
        } else {
            return false;
        }
    }

    public function loser()
    {
        if ($this->played()) {
            $local = 0;
            $visitor = 0;
            foreach ($this->scores as $score) {
                $local += $score->local_score;
                $visitor += $score->visitor_score;
            }
            if ($local > $visitor) {
                return $this->visitorTeam;
            } else {
                return $this->localTeam;
            }
        } else {
            return false;
        }
    }

    public function played()
    {
        $scores = $this->scores->count() > 0 ? TRUE : FALSE;
        if ($scores) {
            $local = null;
            $visitor = null;
            foreach ($this->scores as $score) {
                $local += $score->local_score;
                $visitor += $score->visitor_score;
            }
            if ($local > 0 && $visitor > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function mvp()
    {
        return $top = PlayerStat::
            where('match_id', $this->id)
            // ->whereIn('player_id', function($query) use ($team_id) {
            //    $query->select('id')->from('players')->where('team_id', '=', $team_id);
            // })
            ->select('*', \DB::raw('PTS + REB + AST as TOTAL'))
            ->orderBy('TOTAL', 'desc')
            ->orderBy('PTS', 'desc')
            ->orderBy('REB', 'desc')
            ->orderBy('AST', 'desc')
            ->first();
    }

    public function top_local_player()
    {
        $team_id = $this->localTeam->team->id;
        return $top = PlayerStat::
            where('match_id', $this->id)
            ->whereIn('player_id', function($query) use ($team_id) {
               $query->select('id')->from('players')->where('team_id', '=', $team_id);
            })
            ->select('*', \DB::raw('PTS + REB + AST as TOTAL'))
            ->orderBy('TOTAL', 'desc')
            ->orderBy('PTS', 'desc')
            ->orderBy('REB', 'desc')
            ->orderBy('AST', 'desc')
            ->first();
    }

    public function top_visitor_player()
    {
        $team_id = $this->visitorTeam->team->id;
        return $top = PlayerStat::
            where('match_id', $this->id)
            ->whereIn('player_id', function($query) use ($team_id) {
               $query->select('id')->from('players')->where('team_id', '=', $team_id);
            })
            ->select('*', \DB::raw('PTS + REB + AST as TOTAL'))
            ->orderBy('TOTAL', 'desc')
            ->orderBy('PTS', 'desc')
            ->orderBy('REB', 'desc')
            ->orderBy('AST', 'desc')
            ->first();
    }

    public function localTeam_totals()
    {
        $team_id = $this->localTeam->id;
        return $top = PlayerStat::
            where('match_id', $this->id)
            ->whereIn('player_id', function($query) use ($team_id) {
               $query->select('id')->from('players')->where('team_id', '=', $team_id);
            })
            ->select(
                // \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('SUM(PTS) AS PTS'),
                \DB::raw('SUM(REB) AS REB'),
                \DB::raw('SUM(AST) AS AST'),
                \DB::raw('SUM(BLK) AS BLK'),
                \DB::raw('SUM(STL) AS STL'),
            )
            ->first();
    }

    public function visitorTeam_totals()
    {
        $team_id = $this->visitorTeam->id;
        return $top = PlayerStat::
            where('match_id', $this->id)
            ->whereIn('player_id', function($query) use ($team_id) {
               $query->select('id')->from('players')->where('team_id', '=', $team_id);
            })
            ->select(
                // \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('SUM(PTS) AS PTS'),
                \DB::raw('SUM(REB) AS REB'),
                \DB::raw('SUM(AST) AS AST'),
                \DB::raw('SUM(BLK) AS BLK'),
                \DB::raw('SUM(STL) AS STL'),
            )
            ->first();
    }

    public function votes()
    {
        $pollVotes = MatchPoll::where('match_id', $this->id)->get();
        $result = [];
        $local = 0;
        $visitor = 0;
        if ($pollVotes->count() > 0) {
            foreach ($pollVotes as $pollVote) {
                if ($pollVote->vote == "local") { $local++; } else { $visitor++; }
            }
        }
        $result['local'] = $local;
        $result['visitor'] = $visitor;
        return $result;
    }

    public function votesPercent()
    {
        $pollVotes = MatchPoll::where('match_id', $this->id)->get();
        $result = [];
        $local = 0;
        $visitor = 0;
        if ($pollVotes->count() > 0) {
            foreach ($pollVotes as $pollVote) {
                if ($pollVote->vote == "local") { $local++; } else { $visitor++; }
            }
        }
        $total = $local + $visitor;
        $total_local = ($local / $total) * 100;
        $total_visitor = ($visitor / $total) * 100;
        $result['local'] = $total_local;
        $result['visitor'] = $total_visitor;
        return $result;
    }

    public function userHasVoted()
    {
        $query = MatchPoll::where('match_id', $this->id)->where('user_id', auth()->user()->id)->get();
        if ($query->count() > 0) {
            return true;
        }
        return false;
    }

    public function userVote()
    {
        if ($query = MatchPoll::where('match_id', $this->id)->where('user_id', auth()->user()->id)->first()) {
            return $query->vote;
        }
        return false;
    }

    public function lastClashes()
    {
        $current = $this;
        return Match::
            leftJoin('scores', 'scores.match_id', 'matches.id')
            ->leftJoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
            ->whereNotNull('scores.match_id')
            ->where(function($q) use ($current) {
                $q->where('matches.local_team_id', $current->localTeam->id)
                    ->orWhere('matches.local_team_id', $current->visitorTeam->id);
                })
            ->where(function($q) use ($current) {
                $q->where('matches.visitor_team_id', $current->localTeam->id)
                    ->orWhere('matches.visitor_team_id', $current->visitorTeam->id);
                })
            ->select('matches.*')
            ->orderBy('scores.created_at', 'desc')
            ->groupBy('matches.id', 'scores.created_at')
            ->take(5)
            ->get();
    }

    public function lastClashes_wins()
    {
        $current = $this;
        $regs = Match::
            leftJoin('scores', 'scores.match_id', 'matches.id')
            ->leftJoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
            ->whereNotNull('scores.match_id')
            ->where(function($q) use ($current) {
                $q->where('matches.local_team_id', $current->localTeam->id)
                    ->orWhere('matches.local_team_id', $current->visitorTeam->id);
                })
            ->where(function($q) use ($current) {
                $q->where('matches.visitor_team_id', $current->localTeam->id)
                    ->orWhere('matches.visitor_team_id', $current->visitorTeam->id);
                })
            ->select('matches.*')
            ->orderBy('scores.created_at', 'desc')
            ->groupBy('matches.id', 'scores.created_at')
            ->take(5)
            ->get();

        $local_wins = 0;
        $visitor_wins = 0;
        foreach ($regs as $reg) {
            if ($reg->winner()->team_id == $current->localTeam->id) {
                $local_wins++;
            } else {
                $visitor_wins++;
            }
        }

        $values = [
            'local' => $local_wins,
            'visitor' => $visitor_wins
        ];

        return $values;
    }

    public function userIsParticipant()
    {
        if (($this->localTeam->team->user && $this->localTeam->team->user->id == auth()->user()->id) || ($this->visitorTeam->team->user && $this->visitorTeam->team->user->id == auth()->user()->id)) {
            return true;
        }
        return false;
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }
}
