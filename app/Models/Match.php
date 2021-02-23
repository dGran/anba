<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'round_id',
        'local_team_id',
        'local_manager_id',
        'visitor_team_id',
        'visitor_manager_id',
        'stadium',
        'extra_times',
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

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function poll()
    {
        return $this->hasOne('App\Models\MatchPoll');
    }

    public function playerStats()
    {
        return $this->hasMany('App\Models\PlayerStat');
    }

    public function teamStats()
    {
        return $this->hasMany('App\Models\TeamStat');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
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
            $local = null;
            $visitor = null;
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
            ->select('*', \DB::raw('PTS + REB + AST as TOTAL'))
            ->where('MIN', '>', 0)
            ->where('PTS', '>', 0)
            // ->whereIn('player_id', function($query) use ($team_id) {
            //    $query->select('id')->from('players')->where('team_id', '=', $team_id);
            // })
            ->orderBy('TOTAL', 'desc')
            ->orderBy('PTS', 'desc')
            ->orderBy('REB', 'desc')
            ->orderBy('AST', 'desc')
            ->first();
    }

    public function top_local_player()
    {
        $team_id = $this->localTeam->id;
        return $top = PlayerStat::
            join('players', 'players.id', 'players_stats.player_id')
            ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
            ->join('teams', 'teams.id', 'seasons_teams.team_id')
            ->where('match_id', $this->id)
            ->where('season_team_id', $team_id)
            ->select('players.name as player_name', 'players.img as player_img', 'players.position as player_position', 'teams.short_name as team_short_name', \DB::raw('PTS + REB + AST as TOTAL'), 'players_stats.PTS', 'players_stats.REB', 'players_stats.AST')
            ->orderBy('TOTAL', 'desc')
            ->orderBy('PTS', 'desc')
            ->orderBy('REB', 'desc')
            ->orderBy('AST', 'desc')
            ->first();
    }

    public function top_visitor_player()
    {
        $team_id = $this->visitorTeam->id;
        return $top = PlayerStat::
            join('players', 'players.id', 'players_stats.player_id')
            ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
            ->join('teams', 'teams.id', 'seasons_teams.team_id')
            ->where('match_id', $this->id)
            ->where('season_team_id', $team_id)
            ->select('players.name as player_name', 'players.img as player_img', 'players.position as player_position', 'teams.short_name as team_short_name', \DB::raw('PTS + REB + AST as TOTAL'), 'players_stats.PTS', 'players_stats.REB', 'players_stats.AST')
            ->orderBy('TOTAL', 'desc')
            ->orderBy('PTS', 'desc')
            ->orderBy('REB', 'desc')
            ->orderBy('AST', 'desc')
            ->first();
    }

    // public function top_local_player()
    // {
    //     $team_id = $this->localTeam->id;
    //     return $top = PlayerStat::
    //         where('match_id', $this->id)
    //         ->where('season_team_id', $team_id)
    //         ->select('*', \DB::raw('PTS + REB + AST as TOTAL'))
    //         ->orderBy('TOTAL', 'desc')
    //         ->orderBy('PTS', 'desc')
    //         ->orderBy('REB', 'desc')
    //         ->orderBy('AST', 'desc')
    //         ->first();
    // }

    // public function top_visitor_player()
    // {
    //     $team_id = $this->visitorTeam->id;
    //     return $top = PlayerStat::
    //         where('match_id', $this->id)
    //         ->where('season_team_id', $team_id)
    //         ->select('*', \DB::raw('PTS + REB + AST as TOTAL'))
    //         ->orderBy('TOTAL', 'desc')
    //         ->orderBy('PTS', 'desc')
    //         ->orderBy('REB', 'desc')
    //         ->orderBy('AST', 'desc')
    //         ->first();
    // }

    public function localTeam_playerTotals()
    {
        $team_id = $this->localTeam->id;
        return $data = PlayerStat::
            where('match_id', $this->id)
            // ->whereIn('player_id', function($query) use ($team_id) {
            //    $query->select('id')->from('players')->where('team_id', '=', $team_id);
            // })
            ->where('season_team_id', $team_id)
            ->select(
                \DB::raw('SUM(PTS) AS PTS'),
                \DB::raw('SUM(REB) AS REB'),
                \DB::raw('SUM(AST) AS AST'),
                \DB::raw('SUM(BLK) AS BLK'),
                \DB::raw('SUM(STL) AS STL'),
                \DB::raw('SUM(FGM) AS FGM'),
                \DB::raw('SUM(FGA) AS FGA'),
                \DB::raw('(SUM(FGM) / SUM(FGA)) * 100  AS FGAVG'),
                \DB::raw('SUM(TPM) AS TPM'),
                \DB::raw('SUM(TPA) AS TPA'),
                \DB::raw('(SUM(TPM) / SUM(TPA)) * 100  AS TPAVG'),
                \DB::raw('SUM(FTM) AS FTM'),
                \DB::raw('SUM(FTA) AS FTA'),
                \DB::raw('(SUM(FTM) / SUM(FTA)) * 100  AS FTAVG'),
                \DB::raw('SUM(ORB) AS ORB'),
                \DB::raw('SUM(PF) AS PF'),
            )
            ->first();
    }

    public function visitorTeam_playerTotals()
    {
        $team_id = $this->visitorTeam->id;
        return $data = PlayerStat::
            where('match_id', $this->id)
            // ->whereIn('player_id', function($query) use ($team_id) {
            //    $query->select('id')->from('players')->where('team_id', '=', $team_id);
            // })
            ->where('season_team_id', $team_id)
            ->select(
                \DB::raw('SUM(PTS) AS PTS'),
                \DB::raw('SUM(REB) AS REB'),
                \DB::raw('SUM(AST) AS AST'),
                \DB::raw('SUM(BLK) AS BLK'),
                \DB::raw('SUM(STL) AS STL'),
                \DB::raw('SUM(FGM) AS FGM'),
                \DB::raw('SUM(FGA) AS FGA'),
                \DB::raw('(SUM(FGM) / SUM(FGA)) * 100  AS FGAVG'),
                \DB::raw('SUM(TPM) AS TPM'),
                \DB::raw('SUM(TPA) AS TPA'),
                \DB::raw('(SUM(TPM) / SUM(TPA)) * 100  AS TPAVG'),
                \DB::raw('SUM(FTM) AS FTM'),
                \DB::raw('SUM(FTA) AS FTA'),
                \DB::raw('(SUM(FTM) / SUM(FTA)) * 100  AS FTAVG'),
                \DB::raw('SUM(ORB) AS ORB'),
                \DB::raw('SUM(PF) AS PF'),
            )
            ->first();
    }

    public function localTeam_teamTotals()
    {
        return $data = TeamStat::
            where('match_id', $this->id)
            ->where('season_team_id', $this->localTeam->id)
            ->first();
    }

    public function visitorTeam_teamTotals()
    {
        return $data = TeamStat::
            where('match_id', $this->id)
            ->where('season_team_id', $this->visitorTeam->id)
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
            if ($reg->winner()->id == $current->localTeam->id) {
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
        if (auth()->user()) {
            if (($this->local_manager_id == auth()->user()->id) || ($this->visitor_manager_id == auth()->user()->id)) {
                return true;
            }
        }
        return false;
    }

    public function checkTeamStats()
    {
        $success = 0;
        $warning = 0;
        $error = 0;
        if ($this->teamStats->count() > 0) {
            foreach ($this->teamStats as $stat) {
                if (
                    ($stat->counterattack === 0 || $stat->counterattack > 0)
                    && ($stat->zone === 0 || $stat->zone > 0)
                    && ($stat->second_oportunity === 0 || $stat->second_oportunity > 0)
                    && ($stat->substitute === 0 || $stat->substitute > 0)
                    && ($stat->advantage === 0 || $stat->advantage > 0)
                    && ($stat->AST === 0 || $stat->AST > 0)
                    && ($stat->DRB === 0 || $stat->DRB > 0)
                    && ($stat->ORB === 0 || $stat->ORB > 0)
                    && ($stat->STL === 0 || $stat->STL > 0)
                    && ($stat->BLK === 0 || $stat->BLK > 0)
                    && ($stat->LOS === 0 || $stat->LOS > 0)
                    && ($stat->PF === 0 || $stat->PF > 0)
                ) {
                    if ($stat->zone > 200 || $stat->second_oportunity > 150 || $stat->substitute > 200 || $stat->advantage > 200 || $stat->AST > 60 || $stat->DRB + $stat->ORB > 150 || $stat->STL > 60 || $stat->BLK > 50 || $stat->LOS > 125) {
                        $warning++;
                    } else {
                        $success++;
                    }
                } else {
                    return "error";
                }
            }
        } else {
            return "error";
        }

        if ($error > 0) { return "error"; }
        if ($warning > 0) { return "warning"; }
        if ($success > 0) {
            return "success";
        } else {
            return "error";
        }
    }

    public function checkPlayerStats()
    {
        $success = 0;
        $warning = 0;
        $error = 0;
        if ($this->playerStats->count() > 0) {
            foreach ($this->playerStats as $stat) {
                if ($stat->MIN > 0) {
                    // first check
                    if (
                        ($stat->PTS === 0 || $stat->PTS > 0)
                        && ($stat->REB === 0 || $stat->REB > 0)
                        && ($stat->AST === 0 || $stat->AST > 0)
                        && ($stat->STL === 0 || $stat->STL > 0)
                        && ($stat->BLK === 0 || $stat->BLK > 0)
                        && ($stat->LOS === 0 || $stat->LOS > 0)
                        && ($stat->FGM === 0 || $stat->FGM > 0)
                        && ($stat->FGA === 0 || $stat->FGA > 0)
                        && ($stat->TPM === 0 || $stat->TPM > 0)
                        && ($stat->TPA === 0 || $stat->TPA > 0)
                        && ($stat->FTM === 0 || $stat->FTM > 0)
                        && ($stat->FTA === 0 || $stat->FTA > 0)
                        && ($stat->ORB === 0 || $stat->ORB > 0)
                        && ($stat->PF === 0 || $stat->PF > 0)
                        && ($stat->ML === 0 || $stat->ML > 0)
                    ) {
                        $success++;
                    } else {
                        $warning++;
                    }

                    if ($stat->FGM > $stat->FGA || $stat->TPM > $stat->TPA || $stat->FTM > $stat->FTA || $stat->PTS > 150 || $stat->REB > 75 || $stat->AST > 55 || $stat->STL > 30 || $stat->BLK > 25 || ($stat->FGM + $stat->TPM + $stat->FTM > 99) || ($stat->FGA + $stat->TPA + $stat->FTA > 99) || $stat->LOS > 50 || $stat->ML > 150) {
                        $warning++;
                    }
                }
            }
        } else {
            return "error";
        }

        if ($error > 0) { return "error"; }
        if ($warning > 0) { return "warning"; }
        if ($success > 0) {
            return "success";
        } else {
            return "error";
        }
    }

    public function hasLocalTeamStats()
    {
        $stats = TeamStat::where('match_id', $this->id)->where('season_team_id', $this->local_team_id)->count();
        if ($stats > 0) {
            return true;
        }
        return false;
    }

    public function hasvisitorTeamStats()
    {
        $stats = TeamStat::where('match_id', $this->id)->where('season_team_id', $this->visitor_team_id)->count();
        if ($stats > 0) {
            return true;
        }
        return false;
    }

    public function hasLocalPlayerStats()
    {
        $stats = PlayerStat::where('match_id', $this->id)->where('season_team_id', $this->local_team_id)->count();
        if ($stats > 0) {
            return true;
        }
        return false;
    }

    public function hasvisitorPlayerStats()
    {
        $stats = PlayerStat::where('match_id', $this->id)->where('season_team_id', $this->visitor_team_id)->count();
        if ($stats > 0) {
            return true;
        }
        return false;
    }

    public function canDestroy()
    {
        // apply logic
        if (Score::where('match_id', $this->id)->count() > 0) { return false; }
        if (TeamStat::where('match_id', $this->id)->count() > 0) { return false; }
        if (PlayerStat::where('match_id', $this->id)->count() > 0) { return false; }
        if (MatchPoll::where('match_id', $this->id)->count() > 0) { return false; }
        if (Post::where('match_id', $this->id)->count() > 0) { return false; }
        if (Statement::where('match_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
