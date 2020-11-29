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
        'short_name',
        'conference',
        'division',
        'img',
        'stadium',
        'slug',
    ];

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
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
