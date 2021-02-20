<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonScoreHeader extends Model
{
    use HasFactory;

    protected $table = "seasons_scores_headers";

    protected $fillable = [
        'season_id',
        'score_header_id',
    ];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    public function scoreHeader()
    {
        return $this->belongsTo('App\Models\ScoreHeader', 'score_header_id', 'id');
    }

    public function getName()
    {
        return $this->season->name . ' - ' . $this->scoreHeader->name;
    }

    public function canDestroy()
    {
        // apply logic
        if (Score::where('seasons_scores_headers_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
