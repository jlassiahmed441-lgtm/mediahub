<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicationController;
use App\Http\Controllers\Api\AuthController;

Route::post('/connexion', [AuthController::class, 'connexion']);

Route::get('/publications', [PublicationController::class, 'index']);
Route::get('/publications/{publication}', [PublicationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/publications', [PublicationController::class, 'store']);
    Route::put('/publications/{publication}', [PublicationController::class, 'update']);
    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy']);
});