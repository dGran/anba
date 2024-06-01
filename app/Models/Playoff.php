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
        'num_participants',
        'full_bracket'
    ];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function rounds()
    {
        return $this->hasMany('App\Models\PlayoffRound');
    }

    public function seasonConference()
    {
        return $this->belongsTo('App\Models\SeasonConference', 'season_conference_id', 'id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRound($order)
    {
        return PlayoffRound::where('playoff_id', $this->id)->where('order', $order)->first();
    }

    public function winner()
    {
        $last_round = PlayoffRound::where('playoff_id', $this->id)->orderBy('order', 'desc')->first();
        $final_clash = PlayoffClash::where('round_id', $last_round->id)->first();
        $matches_to_win = $final_clash->round->matches_to_win;
        if ($final_clash->result()['local_result'] == $matches_to_win || $final_clash->result()['visitor_result'] == $matches_to_win) {
            $team_winner = SeasonTeam::find($final_clash->winner()->id);
            return $team_winner;
        }

        return false;
    }

    public function winner_manager()
    {
        $last_round = PlayoffRound::where('playoff_id', $this->id)->orderBy('order', 'desc')->first();
        $final_clash = PlayoffClash::where('round_id', $last_round->id)->first();
        $matches_to_win = $final_clash->round->matches_to_win;
        if ($final_clash->result()['local_result'] == $matches_to_win || $final_clash->result()['visitor_result'] == $matches_to_win) {
            $manager_winner = User::find($final_clash->winner_manager()->id);
            return $manager_winner;
        }

        return false;
    }

    public function canDestroy()
    {
        // apply logic
        return true;
    }
}
