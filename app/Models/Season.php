<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'current',
        'slug'
    ];

    public function conferences() {
        return $this->hasMany('App\Models\SeasonConference');
    }

    public function divisions() {
        return $this->hasMany('App\Models\SeasonDivision');
    }

    public function teams() {
        return $this->hasMany('App\Models\SeasonTeam');
    }

    public function scores_headers() {
        return $this->hasMany('App\Models\SeasonScoreHeader');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('seasons.name', 'LIKE', "%{$value}%")
                                ->orWhere('seasons.id', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }
}
