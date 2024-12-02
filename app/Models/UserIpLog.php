<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIpLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'ip', 'date_last_login', 'counter'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeName($query, $value)
    {
        if (\trim($value) !== "") {
            return $query->where(function($q) use ($value) {
                $q->where('user_ip_logs.ip', 'LIKE', "%{$value}%")
                    ->orWhere('user_ip_logs.location', 'LIKE', "%{$value}%")
                    ->orWhere('users.name', 'LIKE', "%{$value}%");
                })
            ;
        }
    }

    public function scopeUser($query, $value)
    {
        if ($value !== 'all') {
            return $query->where('user_id', '=', $value);
        }
    }

    public function getUserImg(): string
    {
        return $this->user->profile_photo_url;
    }

    public function getName(): string
    {
        return $this->ip;
    }

    public function getDateLastLoginDate(): string
    {
        return Carbon::parse($this->date_last_login)->locale(app()->getLocale())->isoFormat("D MMMM YYYY");
    }

    public function getDateLastLoginTime(): string
    {
        return Carbon::parse($this->date_last_login)->locale(app()->getLocale())->isoFormat("kk[:]mm");
    }

    public function canDestroy()
    {
        // apply logic
        // ....
        return true;
    }

}
