<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'conference_id',
        'active',
        'slug',
    ];

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference');
    }

    public function teams()
    {
        return $this->hasMany('App\Models\Team');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('divisions.name', 'LIKE', "%{$value}%")
                                ->orWhere('divisions.id', 'LIKE', "%{$value}%")
                                ->orWhere('conferences.name', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeConference($query, $value)
    {
        if ($value != 'all') {
            return $query->where('conference_id', '=', $value);
        }
    }

    public function scopeActive($query, $value)
    {
        if ($value != "all") {
            if ($value == "active") {
                return $query->where('divisions.active', 1);
            } else {
                return $query->where('divisions.active', 0);
            }
        }
    }

    public function getConferenceImg()
    {
        $default = asset('storage/conferences/default.png');
        if ($this->conference) {
            return $this->conference->getImg();
        } else {
            return $default;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function canDestroy()
    {
        // apply logic
        if (SeasonDivision::where('division_id', $this->id)->count() > 0) { return false; }
        if (Team::where('division_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
