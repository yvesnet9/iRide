<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// === EcoRide Controllers ===
use App\Http\Controllers\EcoRide\EcoRideController;
use App\Http\Controllers\EcoRide\CarpoolController;
use App\Http\Controllers\EcoRide\UserSpaceController;
use App\Http\Controllers\EcoRide\VehicleController;
use App\Http\Controllers\EcoRide\HistoryController;
use App\Http\Controllers\EcoRide\EmployeeController;
use App\Http\Controllers\EcoRide\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Application iRide / EcoRide
| Authentification gérée par Laravel Breeze
|--------------------------------------------------------------------------
*/


// ======================================================
// ================  ECORIDE PUBLIC  ====================
// ======================================================

// Page d'accueil EcoRide (US1)
Route::get('/', [EcoRideController::class, 'index'])
    ->name('ecoride.home');

// Recherche de covoiturages (US3 + US4)
Route::get('/covoiturages', [CarpoolController::class, 'search'])
    ->name('ecoride.search');

// Détails d’un covoiturage (US5)
Route::get('/covoiturages/{id}', [CarpoolController::class, 'show'])
    ->name('ecoride.show');


// ======================================================
// ==============  ACTIONS UTILISATEUR  =================
// ======================================================

Route::middleware('auth')->group(function () {

    // Réserver un covoiturage (US6)
    Route::post('/covoiturages/{id}/reserver', [CarpoolController::class, 'reserve'])
        ->name('ecoride.reserve');


    // ===============================
    // ===  MON ESPACE UTILISATEUR ===
    // ===============================

    // Page "Mon espace" (US8)
    Route::get('/mon-espace', [UserSpaceController::class, 'index'])
        ->name('user.space');

    // Mise à jour statut chauffeur/passager/both (US8)
    Route::post('/mon-espace/status', [UserSpaceController::class, 'updateStatus'])
        ->name('user.status');

    // Ajout d’un véhicule (US8)
    Route::post('/mon-espace/vehicle', [VehicleController::class, 'store'])
        ->name('vehicle.store');


    // ===============================
    // ===  HISTORIQUE COVOITURAGES ===
    // ===============================

    // Historique des covoiturages (US10)
    Route::get('/historique', [HistoryController::class, 'index'])
        ->name('ecoride.history');

    // Annulation d’une réservation (passager) (US10)
    Route::post('/reservation/{id}/annuler', [HistoryController::class, 'cancelReservation'])
        ->name('reservation.cancel');

    // Annulation d’un trajet (chauffeur) (US10)
    Route::post('/trajet/{id}/annuler', [HistoryController::class, 'cancelTrip'])
        ->name('trip.cancel');


    // ===============================
    // ===  GESTION ÉTAT TRAJET US11 ==
    // ===============================

    // Démarrer un covoiturage (US11)
    Route::post('/trajet/{id}/demarrer', [HistoryController::class, 'startTrip'])
        ->name('trip.start');

    // Arrivée à destination (US11)
    Route::post('/trajet/{id}/terminer', [HistoryController::class, 'finishTrip'])
        ->name('trip.finish');


    // ===============================
    // ===  ESPACE EMPLOYÉ (US12)  ===
    // ===============================

    // Dashboard employé
    Route::get('/employee', [EmployeeController::class, 'index'])
        ->name('employee.dashboard');

    // Validation / refus des avis
    Route::post('/employee/review/{id}/approve', [EmployeeController::class, 'approveReview'])
        ->name('employee.review.approve');

    Route::post('/employee/review/{id}/reject', [EmployeeController::class, 'rejectReview'])
        ->name('employee.review.reject');
});


// ======================================================
// ==============  ESPACE ADMINISTRATEUR (US13) =========
// ======================================================

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard administrateur
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Création compte employé
    Route::post('/admin/employe', [AdminController::class, 'createEmployee'])
        ->name('admin.employee.create');

    // Suspension compte utilisateur / employé
    Route::post('/admin/user/{id}/suspend', [AdminController::class, 'suspend'])
        ->name('admin.user.suspend');
});


// ======================================================
// ==================  DASHBOARD  =======================
// ======================================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
  ->name('dashboard');


// ======================================================
// ==================  PROFIL (Breeze) ==================
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ======================================================
// ==============  AUTHENTIFICATION  ====================
// ======================================================

require __DIR__.'/auth.php';
