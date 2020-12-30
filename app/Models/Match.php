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

    public function played()
    {
        return $this->scores->count() > 0 ? TRUE : FALSE;
    }

    public function top_local_player()
    {
        $team_id = $this->localTeam->team->id;
        return $top = PlayerStat::
            where('match_id', $this->id)
            ->whereIn('player_id', function($query) use ($team_id) {
               $query->select('id')->from('players')->where('team_id', '=', $team_id);
            })
            ->orderBy('PTS', 'desc')
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
            ->orderBy('PTS', 'desc')
            ->first();
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }
}
