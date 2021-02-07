<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nickname',
        'team_id',
        'img',
        'position',
        'height',
        'weight',
        'college',
        'birthdate',
        'nation_name',
        'draft_year',
        'average',
        'retired',
        'injury_id',
        'injury_matches',
        'injury_days',
        'injury_playable',
        'slug'
    ];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function injury()
    {
        return $this->belongsTo('App\Models\Injury');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('players.name', 'LIKE', "%{$value}%")
                                ->orWhere('players.id', 'LIKE', "%{$value}%")
                                ->orWhere('players.nation_name', 'LIKE', "%{$value}%")
                                ->orWhere('players.college', 'LIKE', "%{$value}%")
                                ->orWhere('teams.name', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopePosition($query, $value)
    {
        if ($value != 'all') {
            return $query->where('position', '=', $value);
        }
    }

    public function scopeTeam($query, $value)
    {
        if ($value != 'all') {
            if ($value != 'free_agents') {
                return $query->where('team_id', '=', $value);
            } else {
                return $query->whereNull('team_id')->where('retired', 0);
            }
        }
    }

    public function scopeHeight($query, $value)
    {
        if ($value['from'] > 5 || $value['to'] < 8) {
            return $query->whereBetween('height', array($value['from'], $value['to']));
        }
    }

    public function scopeWeight($query, $value)
    {
        if ($value['from'] > 125 || $value['to'] < 500) {
            return $query->whereBetween('weight', array($value['from'], $value['to']));
        }
    }

    public function scopeCollege($query, $value)
    {
        if ($value != 'all') {
            return $query->where('college', 'LIKE', "%{$value}%");
        }
    }

    public function scopeNation($query, $value)
    {
        if ($value != 'all') {
            return $query->where('nation_name', 'LIKE', "%{$value}%");
        }
    }

    public function scopeAge($query, $value)
    {
        if ($value['from'] > 15 || $value['to'] < 45) {
            $date = Carbon::now();
            $fromDate = $date->subYears($value['from'])->toDateString();
            $date = Carbon::now();
            $toDate = $date->subYears($value['to'])->toDateString();

            return $query->where('birthdate', '>=', $toDate)->where('birthdate', '<=', $fromDate);
        }
    }


    public function scopeYearDraft($query, $value)
    {
        if ($value['from'] > 1995 || $value['to'] < 2020) {
            return $query->whereBetween('draft_year', array($value['from'], $value['to']));
        }
    }

    public function scopeRetired($query, $value)
    {
        if ($value != "all") {
            if ($value == "active") {
                return $query->where('retired', 0);
            } else {
                return $query->where('retired', 1);
            }
        }
    }

    public function storageImg()
    {
        if (substr($this->img, 0, 7) == "players") {
            return true;
        }
        return false;
    }

    public function getImg()
    {
        $default = asset('storage/players/default.png');
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

    public function getTeamImg()
    {
        $free = asset('img/free.png');
        if ($this->team) {
            return $this->team->getImg();
        } else {
            return $free;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPosition()
    {
        switch ($this->position) {
            case 'pg':
                return "Base";
                break;
            case 'sg':
                return "Escolta";
                break;
            case 'sf':
                return "Alero";
                break;
            case 'pf':
                return "Ala-Pivot";
                break;
            case 'c':
                return "Pivot";
                break;
            // case 'pg':
            //     return "Point guard";
            //     break;
            // case 'sg':
            //     return "Shooting guard";
            //     break;
            // case 'sf':
            //     return "Small forward";
            //     break;
            // case 'pf':
            //     return "Power forward";
            //     break;
            // case 'c':
            //     return "Center";
            //     break;
        }
    }

    public function getPositionOrdered()
    {
        switch ($this->position) {
            case 'pg':
                return 1;
                break;
            case 'sg':
                return 2;
                break;
            case 'sf':
                return 3;
                break;
            case 'pf':
                return 4;
                break;
            case 'c':
                return 5;
                break;
        }
    }

    public function getHeight()
    {
        return strtr($this->height, ".", "-");
    }

    public function age()
    {
        if ($this->birthdate) {
            return Carbon::parse($this->birthdate)->age;
        }
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
