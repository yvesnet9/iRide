<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ------------------------------------
        // 🌱 1. Création des utilisateurs
        // ------------------------------------

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'role' => 'employee',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Standard User',
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        // ------------------------------------
        // 🌱 2. Création des véhicules EcoRide
        // ------------------------------------

        Vehicle::insert([
            [
                'name'      => 'EcoRide Compact EV',
                'type'      => 'Voiture électrique',
                'autonomy'  => 320,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'EcoRide Family EV',
                'type'      => 'Voiture électrique',
                'autonomy'  => 410,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'      => 'EcoRide Urban EV',
                'type'      => 'Voiture électrique',
                'autonomy'  => 280,
                'available' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
