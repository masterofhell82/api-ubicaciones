<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;

/**
 * Endpoints for the API
 */
Route::middleware(['api'])->group(function () {

    // Routes for user
    Route::group(['prefix' => 'user'], function () {
        Route::get('/locations', [LocationController::class, 'locations']);
        Route::post('/location', [LocationController::class, 'store']);
        Route::put('/user_location', [LocationController::class, 'update']);
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
    });

    // Routes for authentication
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});
