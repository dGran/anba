<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

    protected $table = "injuries";
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('injuries.name', 'LIKE', "%{$value}%")
                                ->orWhere('injuries.id', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function canDestroy()
    {
        // apply logic
        if (Player::where('injury_id', $this->id)->count() > 0) { return false; }
        if (PlayerStat::where('injury_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
