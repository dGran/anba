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

    public function matches()
    {
        return $this->hasMany('App\Models\Match', 'clash_id', 'id');
    }

    public function localResult()
    {
        $result = 0;
        foreach ($this->matches as $match) {
            if ($match->winner()) {
                if ($this->local_team_id == $match->local_team_id) {
                    if ($match->winner()->id == $this->local_team_id) {
                        $result++;
                    }
                } else {
                    if ($match->winner()->id == $this->visitor_team_id) {
                        $result++;
                    }
                }
            }
        }
        return $result;
    }

    public function visitorResult()
    {
        $result = 0;
        foreach ($this->matches as $match) {
            if ($match->winner()) {
                if ($this->visitor_team_id == $match->visitor_team_id) {
                    if ($match->winner()->id == $this->visitor_team_id) {
                        $result++;
                    }
                } else {
                    if ($match->winner()->id == $this->local_team_id) {
                        $result++;
                    }
                }
            }
        }
        return $result;
    }

    public function previousClash($position)
    {
        $local = $position == 'local' ? 1 : NULL;
        $clash = PlayoffClash::where('destiny_clash', $this->id)->where('destiny_clash_local', $local)->first();
        if ($clash) {
            $text = $clash->localTeam ? $clash->localTeam->team->medium_name : 'indefinido';
            $text .= ' vs ';
            $text .= $clash->visitorTeam ? $clash->visitorTeam->team->medium_name : 'indefinido';
            return $text;
        } else {
            return false;
        }
    }

    public function bracketPosition()
    {
        $last_round = PlayoffRound::where('playoff_id', $this->round->playoff->id)->orderBy('order', 'desc')->first();
        if ($this->round->playoff->full_bracket) {
            if ($this->order <= ($this->round->clashes->count() / 2)) {
                $position = "left";
            } else {
                $position = "right";
            }
            if ($this->round_id == $last_round->id) {
                $position = "center";
            }
            return $position;
        }
        return 'left';
    }

    public function canDestroy()
    {
        // apply logic
        return true;
    }

}
