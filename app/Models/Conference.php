<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'active',
        'slug',
    ];

    public function divisions()
    {
        return $this->hasMany('App\Models\Division');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('conferences.name', 'LIKE', "%{$value}%")
                                ->orWhere('conferences.id', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeActive($query, $value)
    {
        if ($value != "all") {
            if ($value == "active") {
                return $query->where('active', 1);
            } else {
                return $query->where('active', 0);
            }
        }
    }

    public function storageImg()
    {
        if (substr($this->img, 0, 11) == "conferences") {
            return true;
        }
        return false;
    }

    public function getImg()
    {
        $default = asset('storage/conferences/default.png');
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

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }
}