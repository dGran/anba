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
            return $query->where('value', 'LIKE', "%{$value}%");
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
        if ($value['from'] > 150 || $value['to'] < 250) {
            return $query->whereBetween('height', array($value['from'], $value['to']));
        }
    }

    public function scopeWeight($query, $value)
    {
        if ($value['from'] > 50 || $value['to'] < 150) {
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
                return "Base";
                break;
            case 'escolta':
                return "Escolta";
                break;
            case 'alero':
                return "Alero";
                break;
            case 'ala-pivot':
                return "Ala-Pivot";
                break;
            case 'pivot':
                return "Pivot";
                break;
        }
    }

    public function getPositionShort()
    {
        switch ($this->position) {
            case 'base':
                return "B";
                break;
            case 'escolta':
                return "E";
                break;
            case 'alero':
                return "A";
                break;
            case 'ala-pivot':
                return "AP";
                break;
            case 'pivot':
                return "P";
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
