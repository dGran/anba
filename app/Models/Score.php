<?php

namespace App\Models;

use Carbon\Carbon;
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
        'order',
        'updated_user_id',
        'created_at',
        'updated_at',
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function season_score_headers()
    {
        return $this->belongsTo('App\Models\SeasonScoreHeader', 'seasons_scores_headers_id', 'id');
    }


    public function getCreatedAtDate()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("D MMMM YYYY");
    }

    public function getCreatedAtTime()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("HH:mm");
    }

    public function getUpdatedAt()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        // return $date->isoFormat("D MMMM YYYY - kk[:]mm");
        return $date->diffForHumans();
    }

    public function getName()
    {
        return "Resultado partido " . $this->match->getName();
    }

}
