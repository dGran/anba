<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonDivision extends Model
{
    use HasFactory;

	protected $table = 'seasons_divisions';

    protected $fillable = [
        'season_id', 'division_id', 'season_conference_id'
    ];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function seasonConference()
    {
        return $this->belongsTo('App\Models\SeasonConference', 'season_conference_id', 'id');
    }

    public function getName()
    {
        return $this->season->name . ' - ' . $this->division->name;
    }
}
