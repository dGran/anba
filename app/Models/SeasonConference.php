<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonConference extends Model
{
    use HasFactory;

	protected $table = 'seasons_conferences';

    protected $fillable = [
        'season_id', 'conference_id',
    ];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id', 'id');
    }

    public function getName()
    {
        return $this->season->name . ' - ' . $this->conference->name;
    }

    public function canDestroy()
    {
        // apply logic

        return true;
    }
}
