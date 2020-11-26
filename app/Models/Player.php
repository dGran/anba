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
        'img',
        'position',
        'height',
        'weight',
        'college',
        'birthdate',
        'nation_name',
        'draft_year',
        'average',
        'slug'
    ];

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('name', 'LIKE', "%{$value}%");
        }
    }

    public function scopePosition($query, $value)
    {
        if ($value != 'all') {
            return $query->where('position', '=', $value);
        }
    }

    public function scopeHeight($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('height', 'LIKE', "%{$value}%");
        }
        // if ($value['from'] > 150 || $value['to'] < 250) {
        //     return $query->whereBetween('height', array($value['from'], $value['to']));
        // }
    }

    public function scopeWeight($query, $value)
    {
        if ($value['from'] > 125 || $value['to'] < 500) {
            return $query->whereBetween('weight', array($value['from'], $value['to']));
        }
    }

    public function scopeCollege($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('college', 'LIKE', "%{$value}%");
        }
    }

    public function scopeNation($query, $value)
    {
        if (trim($value) != "") {
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

    public function getName()
    {
        return $this->name;
    }

    public function getPosition()
    {
        switch ($this->position) {
            case 'base':
                return "Point guard";
                break;
            case 'escolta':
                return "Shooting guard";
                break;
            case 'alero':
                return "Small forward";
                break;
            case 'ala-pivot':
                return "Power forward";
                break;
            case 'pivot':
                return "Center";
                break;
        }
    }

    public function getPositionShort()
    {
        switch ($this->position) {
            case 'base':
                return "PG";
                break;
            case 'escolta':
                return "SG";
                break;
            case 'alero':
                return "SF";
                break;
            case 'ala-pivot':
                return "PF";
                break;
            case 'pivot':
                return "C";
                break;
        }
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
