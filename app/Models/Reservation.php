<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'trip_id',
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function trip() {
        return $this->belongsTo(\App\Models\Trip::class);
    }
}
