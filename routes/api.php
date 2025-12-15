<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IncidentController;

/*
|--------------------------------------------------------------------------
| Test API (debug)
|--------------------------------------------------------------------------
*/
Route::get('/test-api', function () {
    return response()->json([
        'message' => 'API OK'
    ]);
});

/*
|--------------------------------------------------------------------------
| Healthcheck PostgreSQL
|--------------------------------------------------------------------------
*/
Route::get('/health/db', function () {
    try {
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'success',
            'message' => 'PostgreSQL OK via Laravel'
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

/*
|--------------------------------------------------------------------------
| Incidents MongoDB (NoSQL)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/incidents', [IncidentController::class, 'store']);
    Route::get('/incidents', [IncidentController::class, 'index']);
});
