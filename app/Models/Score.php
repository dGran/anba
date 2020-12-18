<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'seasons_scores_headers_id',
        'local_score',
        'visitor_score',
        'order'
    ];

    public function season_score_headers()
    {
        return $this->belongsTo('App\Models\SeasonScoreHeader', 'seasons_scores_headers_id', 'id');
    }

}
