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
        'injury_id',
        'injury_matches',
        'injury_days',
        'injury_playable',
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
        'ORB',
        'PF',
        'ML',
        'headline',
        'updated_user_id',
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    public function injury()
    {
        return $this->belongsTo('App\Models\Injury');
    }

    public function seasonTeam()
    {
        return $this->belongsTo('App\Models\SeasonTeam', 'season_team_id', 'id');
    }

    public function getName()
    {
        return "Estadísticas " . $this->player->getName() . ", partido " . $this->match->getName();
    }
}
