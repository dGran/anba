<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id',
        'manager_id',
        'medium_name',
        'short_name',
        'img',
        'stadium',
        'color',
        'active',
        'slug',
    ];

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'manager_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('teams.name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.id', 'LIKE', "%{$value}%")
                                ->orWhere('teams.medium_name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.short_name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.stadium', 'LIKE', "%{$value}%")
                                ->orWhere('divisions.name', 'LIKE', "%{$value}%")
                                ->orWhere('users.name', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeDivision($query, $value)
    {
        if ($value != 'all') {
            return $query->where('division_id', '=', $value);
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

    public function storageImg()
    {
        if (substr($this->img, 0, 5) == "teams") {
            return true;
        }
        return false;
    }

    public function getImg()
    {
        $default = asset('storage/teams/default.png');
        $local = asset('storage/' . $this->img);
        $broken = asset('img/broken.png');

        if ($this->img) {
            if ($this->storageImg()) {
                if (Storage::disk('public')->exists($this->img)) {
                    return $local;
                } else {
                    return $broken;
                }
            } else {
                return $this->img;
            }
        } else {
            return $default;
        }
    }

    public function getUserImg()
    {
        if ($this->user) {
            return $this->user->profile_photo_url;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAtDate()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("D MMMM YYYY");
    }

    public function getCreatedAtTime()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("kk[:]mm");
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }
}
