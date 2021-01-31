<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamStat extends Model
{
    use HasFactory;

    protected $table = "teams_stats";

    protected $fillable = [
        'match_id',
        'season_id',
        'season_team_id',
        'counterattack',
        'zone',
        'second_oportunity',
        'substitute',
        'advantage',
        'AST',
        'DRB',
        'ORB',
        'STL',
        'BLK',
        'LOS',
        'PF'
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function seasonTeam()
    {
        return $this->belongsTo('App\Models\SeasonTeam', 'season_team_id', 'id');
    }
}
