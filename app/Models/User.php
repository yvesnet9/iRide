<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * ATTRIBUTS ASSIGNABLES
     */
    protected $fillable = [
        'name',
        'pseudo',          // ✔ US7 : pseudo ajouté
        'email',
        'password',
        'role',            // admin / employee / user
        'credits',         // ✔ US7 : 20 crédits à l'inscription
        'driver_status',   // ✔ US8 : passenger / driver / both
    ];

    /**
     * ATTRIBUTS CACHÉS
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * CONVERSIONS AUTOMATIQUES
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * RELATION : un utilisateur peut avoir plusieurs véhicules
     * (US8)
     */
    public function vehicles()
    {
        return $this->hasMany(\App\Models\Vehicle::class);
    }
}
