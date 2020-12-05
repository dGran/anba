<?php

namespace App\Models;

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
}
