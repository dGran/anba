<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayoffClash extends Model
{
    use HasFactory;

    protected $table = "playoffs_clashes";
    public $timestamps = false;

    protected $fillable = [
        'round_id',
        'local_team_id',
        'visitor_team_id',
        'order',
        'destiny_order'
    ];

    public function round()
    {
        return $this->belongsTo('App\Models\PlayoffRound', 'round_id', 'id');
    }

    public function localTeam()
    {
        return $this->hasOne('App\Models\SeasonTeam', 'id', 'local_team_id');
    }

    public function visitorTeam()
    {
        return $this->hasOne('App\Models\SeasonTeam', 'id', 'visitor_team_id');
    }

    public function canDestroy()
    {
        // apply logic
        return true;
    }

}
