<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonTeam extends Model
{
    use HasFactory;

    protected $table = 'seasons_teams';

    protected $fillable = [
        'season_id', 'team_id', 'season_division_id'
    ];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function seasonDivision()
    {
        return $this->belongsTo('App\Models\SeasonDivision', 'season_division_id', 'id');
    }

    public function getName()
    {
        return $this->season->name . ' - ' . $this->team->name;
    }

    public function lastMatches()
    {
        return $regs = Match::
            leftJoin('scores', 'scores.match_id', 'matches.id')
            ->leftJoin('seasons_teams', function($join){
                $join->on('seasons_teams.id','=','matches.local_team_id');
                $join->orOn('seasons_teams.id','=','matches.visitor_team_id');
            })
            // ->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            // ->leftJoin('users', function($join){
            //     $join->on('users.id','=','matches.local_manager_id');
            //     $join->orOn('users.id','=','matches.visitor_manager_id');
            // })
            ->team($this->id)
            ->whereNotNull('scores.match_id')
            ->select('matches.*')
            ->orderBy('scores.created_at', 'desc')
            ->groupBy('matches.id', 'scores.created_at')
            ->take(5)
            ->get();
    }

    public function canDestroy()
    {
        // apply logic
        if (Transfer::where('season_team_from', $this->id)->orWhere('season_team_to', $this->id)->count() > 0) { return false; }
        if (TeamStat::where('season_team_id', $this->id)->count() > 0) { return false; }
        if (PlayerStat::where('season_team_id', $this->id)->count() > 0) { return false; }
        if (Match::where('local_team_id', $this->id)->orWhere('visitor_team_id', $this->id)->count() > 0) { return false; }
        //pending
        // RoundParticipant
        // RoundClash

        return true;
    }
}
