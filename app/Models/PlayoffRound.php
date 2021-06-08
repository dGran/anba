<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayoffRound extends Model
{
    use HasFactory;

    protected $table = "playoffs_rounds";
    public $timestamps = false;

    protected $fillable = [
        'playoff_id',
        'name',
        'matches_to_win',
        'matches_max'
    ];

    public function playoff()
    {
        return $this->belongsTo('App\Models\Playoff', 'playoff_id', 'id');
    }

    public function clashes()
    {
        return $this->hasMany('App\Models\PlayoffClash', 'round_id', 'id');
    }

    public function previousRound()
    {
        if ($this->order != 1) {
            $order = $this->order - 1;
            $round = PlayoffRound::where('playoff_id', $this->playoff_id)->where('order', $order)->first();
            if ($round) {
                return $round->id;
            } else {
                return false;
            }
        }
        return false;
    }

    public function getClash($order)
    {
        return PlayoffClash::where('round_id', $this->id)->where('order', $order)->first();
    }

    public function canDestroy()
    {
        // apply logic
        return true;
    }
}
