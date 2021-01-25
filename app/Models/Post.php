<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
    	'type',
    	'match_id',
    	'statement_id',
    	'transfer_id',
    	'category',
    	'title',
    	'description',
    	'img',
        'slug'
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\Match');
    }

    public function statement()
    {
        return $this->belongsTo('App\Models\Statement');
    }

    public function transfer()
    {
        return $this->belongsTo('App\Models\Transfer');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('posts.category', 'LIKE', "%{$value}%")
                                ->orWhere('posts.id', 'LIKE', "%{$value}%")
                                ->orWhere('posts.title', 'LIKE', "%{$value}%")
                                ->orWhere('posts.description', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeType($query, $value)
    {
        if ($value != 'all') {
            return $query->where('type', '=', $value);
        }
    }

    public function storageImg()
    {
        if (substr($this->img, 0, 5) == "posts") {
            return true;
        }
        return false;
    }

    public function getImg()
    {
        switch ($this->type) {
            case 'general': $default = asset('storage/posts/defaults/default.png'); break;
            case 'resultados': $default = asset('storage/posts/defaults/results.svg'); break;
            case 'records': $default = asset('storage/posts/defaults/default.png'); break;
            case 'rachas': $default = asset('storage/posts/defaults/default.png'); break;
            case 'lesiones': $default = asset('storage/posts/defaults/injury.svg'); break;
            case 'movimientos': $default = asset('storage/posts/defaults/default.png'); break;
            case 'destacados': $default = asset('storage/posts/defaults/default.png'); break;
            case 'declaraciones': $default = asset('storage/posts/defaults/statement.svg'); break;
        }
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
        return $this->title;
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
