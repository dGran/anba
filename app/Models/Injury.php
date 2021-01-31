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
}
