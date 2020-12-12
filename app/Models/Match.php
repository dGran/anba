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
        return $this->belongsTo('App\Models\User', 'id', 'local_manager_id');
    }

    public function visitorManager()
    {
        return $this->belongsTo('App\Models\User', 'id', 'visitor_manager_id');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('matches.id', 'LIKE', "%{$value}%")
                                ->orWhere('matches.stadium', 'LIKE', "%{$value}%")
                                ->orWhere('teams.name', 'LIKE', "%{$value}%")
                                ->orWhere('users.name', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeSeason($query, $value)
    {
        if ($value != 'all') {
            return $query->where('matches.season_id', '=', $value);
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
        return $this->localTeam->team->name . ' vs ' . $this->visitorTeam->team->name;
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }
}
