<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreHeader extends Model
{
    use HasFactory;

	protected $table = "scores_headers";

    protected $fillable = [
        'name',
        'active',
        'order',
    ];

    public function canDestroy()
    {
        // apply logic
        if (SeasonScoreHeader::where('score_header_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
