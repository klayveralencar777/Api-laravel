<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'showById']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::post('/auth', [AuthController::class, 'login']);
    
    Route::middleware(['auth.custom'])->group(function() {
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/reviews', [ReviewController::class, 'index']);
        Route::get('/reviews/{id}', [ReviewController::class, 'showById']);
        Route::post('/reviews', [ReviewController::class, 'store']);
        

    });
    
});
