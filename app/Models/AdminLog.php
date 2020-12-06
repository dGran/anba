<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'table', 'reg_id', 'reg_name', 'detail', 'detail_before'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('admin_logs.reg_name', 'LIKE', "%{$value}%")
                            	->orWhere('admin_logs.reg_id', 'LIKE', "%{$value}%")
                            	->orWhere('admin_logs.table', 'LIKE', "%{$value}%")
                                ->orWhere('admin_logs.id', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeType($query, $value)
    {
        if ($value != 'all') {
            return $query->where('type', '=', $value);
        }
    }

    public function scopeUser($query, $value)
    {
        if ($value != 'all') {
            return $query->where('user_id', '=', $value);
        }
    }

    public function scopeTable($query, $value)
    {
        if ($value != 'all') {
            return $query->where('table', '=', $value);
        }
    }

    public function getUserImg()
    {
        return $this->user->profile_photo_url;
    }

    public function getName()
    {
        return $this->reg_name;
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
