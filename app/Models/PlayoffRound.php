<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayoffRound extends Model
{
    use HasFactory;

    public const NAME_FINAL = 'Final';

    public const NAME_SEMIFINAL = 'Semifinal';

    public const NAME_PRIMERA_RONDA = 'Primera ronda';

    public const NAME_SEMIFINAL_CONF = 'Semifinal Conf.';

    public const FINAL_CONF = 'Final Conf.';

    public const FINAL_ANBA = 'Final Anba';

    public $timestamps = false;

    protected $table = "playoffs_rounds";

    protected $fillable = [
        'playoff_id',
        'name',
        'matches_to_win',
        'matches_max',
        'order'
    ];

    public function playoff()
    {
        return $this->belongsTo('App\Models\Playoff', 'playoff_id', 'id');
    }

    public function clashes()
    {
        return $this->hasMany('App\Models\PlayoffClash', 'round_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
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
        return PlayoffClash::with('matches.scores', 'matches.localTeam', 'matches.visitorTeam')->where('round_id', $this->id)->where('order', $order)->first();
    }

    public function canDestroy()
    {
        // apply logic
        return true;
    }
}
