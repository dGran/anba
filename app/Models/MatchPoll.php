<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchPoll extends Model
{
    use HasFactory;

    protected $table = "matches_polls";
    protected $fillable = ['match_id', 'user_id', 'vote'];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
