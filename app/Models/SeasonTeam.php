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
}