<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStat extends Model
{
    use HasFactory;

    protected $table = "players_stats";

    protected $fillable = [
        'match_id',
        'season_id',
        'player_id',
        'season_team_id',
        'MIN',
        'PTS',
        'REB',
        'AST',
        'STL',
        'BLK',
        'LOS',
        'FGM',
        'FGA',
        'TPM',
        'TPA',
        'FTM',
        'FTA',
        'OR',
        'PF',
        'ML',
        'headline',
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    public function seasonTeam()
    {
        return $this->belongsTo('App\Models\SeasonTeam', 'season_team_id', 'id');
    }

}
