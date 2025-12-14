<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * Champs assignables (mass assignment)
     */
   protected $fillable = [
    'user_id',
    'name',
    'type',
    'autonomy',
    'plate',
    'first_registration',
    'brand',
    'model',
    'color',
    'seats',
    'smoker_allowed',
    'pets_allowed',
    ];

    /**
     * RELATION : un véhicule appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
