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
        'local_manager_id',
        'visitor_manager_id',
        'regular_position_local',
        'regular_position_visitor',
        'order',
        'destiny_clash',
        'destiny_clash_local'
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

    public function localManager()
    {
        return $this->belongsTo('App\Models\User', 'local_manager_id', 'id');
    }

    public function visitorManager()
    {
        return $this->belongsTo('App\Models\User', 'visitor_manager_id', 'id');
    }

    public function matches()
    {
        return $this->hasMany('App\Models\Match', 'clash_id', 'id');
    }

    public function result()
    {
        $local_result = "-";
        $visitor_result = "-";
        if ($this->matches->count() > 0) {
            $local_result = 0;
            $visitor_result = 0;
            foreach ($this->matches as $match) {
                if ($match->winner()) {
                    if ($this->local_team_id == $match->local_team_id) {
                        if ($match->winner()->id == $this->local_team_id) {
                            $local_result++;
                        } else {
                            $visitor_result++;
                        }
                    } else {
                        if ($match->winner()->id == $this->visitor_team_id) {
                            $visitor_result++;
                        } else {
                            $local_result++;
                        }
                    }
                }
            }
        }
        if ($local_result == 0 && $visitor_result == 0) {
            $local_result = "-";
            $visitor_result = "-";
        }

        $result = [
            'local_result' => $local_result,
            'visitor_result' => $visitor_result
        ];

        return $result;
    }

    public function winner()
    {
        $local_result = $this->result()['local_result'];
        $visitor_result = $this->result()['visitor_result'];

        if ($local_result > $visitor_result) {
            return $this->localTeam;
        } else {
            return $this->visitorTeam;
        }
    }

    public function loser()
    {
        $local_result = $this->result()['local_result'];
        $visitor_result = $this->result()['visitor_result'];

        if ($local_result > $visitor_result) {
            return $this->visitorTeam;
        } else {
            return $this->localTeam;
        }
    }

    public function previousClash($position)
    {
        $local = $position == 'local' ? 1 : NULL;
        $clash = PlayoffClash::where('destiny_clash', $this->id)->where('destiny_clash_local', $local)->first();
        if ($clash) {
            $text = $clash->localTeam ? $clash->localTeam->team->medium_name : 'N/D';
            $text .= ' / ';
            $text .= $clash->visitorTeam ? $clash->visitorTeam->team->medium_name : 'N/D';
            return $text;
        } else {
            return false;
        }
    }

    public function nextClash()
    {
        $next_round = PlayoffRound::where('playoff_id', $this->round->playoff->id)->where('order', '>', $this->round->order)->orderBy('order', 'asc')->first();
        if ($next_round) {
            return $clash = PlayoffClash::where('round_id', $next_round->id)->where('order', $this->destiny_clash)->first();
        }

        return false;
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
