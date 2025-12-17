<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IncidentController;

/*
|--------------------------------------------------------------------------
| API – Test simple
|--------------------------------------------------------------------------
| Vérifie que l’API Laravel répond
*/
Route::get('/test-api', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API OK',
        'timestamp' => now()->toDateTimeString(),
    ]);
});

/*
|--------------------------------------------------------------------------
| API – Healthcheck PostgreSQL (Neon / Render)
|--------------------------------------------------------------------------
| Affiche l’erreur réelle en cas d’échec (TEMPORAIRE)
*/
Route::get('/health/db', function () {
    try {
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'success',
            'message' => 'PostgreSQL OK via Laravel',
            'driver' => DB::connection()->getDriverName(),
            'timestamp' => now()->toDateTimeString(),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'error_class' => get_class($e),
            'error_message' => $e->getMessage(),
            'timestamp' => now()->toDateTimeString(),
        ], 500);
    }
});

/*
|--------------------------------------------------------------------------
| API – Incidents (MongoDB)
|--------------------------------------------------------------------------
| Routes protégées par Sanctum
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/incidents', [IncidentController::class, 'store']);
    Route::get('/incidents', [IncidentController::class, 'index']);
});
