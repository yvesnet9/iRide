<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'departure',
        'arrival',
        'date',
        'time',
        'driver_name',
        'price',
        'seats',
        'vehicle_type',
    ];

    public $timestamps = false;

    // Relation : un trajet peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class);
    }
}
