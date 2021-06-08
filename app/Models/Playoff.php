<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playoff extends Model
{
    use HasFactory;

    protected $table = "playoffs";
    public $timestamps = false;

    protected $fillable = [
        'season_id',
        'name',
        'playin_place',
        'season_conference_id',
        'order',
        'num_participants'
    ];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function rounds()
    {
        return $this->hasMany('App\Models\PlayoffRound');
    }

    public function getRound($order)
    {
        return PlayoffRound::where('playoff_id', $this->id)->where('order', $order)->first();
    }

    public function canDestroy()
    {
        // apply logic
        return true;
    }
}
