<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = "config";
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'active_notifications',
        'notifications_test_mode',
        'home_banner',
    ];
}
