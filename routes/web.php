<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcoRide\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Application iRide / EcoRide
| Authentification gérée par Laravel Breeze
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware(['auth'])->group(function () {

    // Dashboard utilisateur classique
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Routes ADMIN
    |--------------------------------------------------------------------------
    | Accès réservé aux administrateurs
    */
    Route::middleware(['admin'])->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

    });
});
