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
}
