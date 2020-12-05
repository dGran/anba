<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'slug',
    ];

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference');
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
        if (substr($this->img, 0, 9) == "divisions") {
            return true;
        }
        return false;
    }

    public function getImg()
    {
        $default = asset('storage/divisions/default.png');
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