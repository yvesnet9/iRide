<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcoRide\VehicleController;
use App\Http\Controllers\EcoRide\TripController;

/*
|--------------------------------------------------------------------------
| Routes du module EcoRide
|--------------------------------------------------------------------------
| Ces routes sont accessibles uniquement aux utilisateurs connectés
| et vérifiés. Elles couvrent :
| - la consultation des véhicules EcoRide
| - la création d’un trajet (US9)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Consultation EcoRide (existant)
    |--------------------------------------------------------------------------
    */

    // Liste des véhicules EcoRide
    Route::get('/ecoride', [VehicleController::class, 'index'])
        ->name('ecoride.index');

    // Détail d’un véhicule EcoRide
    Route::get('/ecoride/{vehicle}', [VehicleController::class, 'show'])
        ->name('ecoride.show');

    /*
    |--------------------------------------------------------------------------
    | US9 : Saisir un voyage (chauffeur)
    |--------------------------------------------------------------------------
    */

    // Formulaire de création d’un trajet
    Route::get('/trips/create', [TripController::class, 'create'])
        ->name('trips.create');

    // Enregistrement du trajet
    Route::post('/trips', [TripController::class, 'store'])
        ->name('trips.store');
});
