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
        'player_id',
        'team_id',
    	'category',
    	'title',
    	'description',
    	'img',
        'slug'
    ];

    public function match()
    {
        return $this->belongsTo('App\Models\MatchModel', 'match_id', 'id');
    }

    public function statement()
    {
        return $this->belongsTo('App\Models\Statement');
    }

    public function transfer()
    {
        return $this->belongsTo('App\Models\Transfer');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
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
            case 'general': $default = asset('storage/posts/defaults/general.png'); break;
            case 'resultados': $default = asset('storage/posts/defaults/results.svg'); break;
            case 'records': $default = asset('storage/posts/defaults/general.png'); break;
            case 'rachas': $default = asset('storage/posts/defaults/general.png'); break;
            case 'lesiones': $default = asset('storage/posts/defaults/injury.svg'); break;
            case 'movimientos': $default = asset('storage/posts/defaults/general.png'); break;
            case 'destacados': $default = asset('storage/posts/defaults/general.png'); break;
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
            switch ($this->type) {
                case 'general': return $default; break;
                case 'resultados': return $default; break;
                case 'records': return $default; break;
                case 'rachas': return $default; break;
                case 'lesiones':
                    if ($this->player_id) {
                        return $this->player->getImg();
                    } else {
                        return $default;
                    }
                    break;
                case 'movimientos': return $default; break;
                case 'destacados':
                    if ($this->team_id) {
                        return $this->team->getImg();
                    } else {
                        return $default;
                    }
                    break;
                case 'declaraciones': return $default; break;
            }
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
        return true;
    }
}
