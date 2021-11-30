<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentalController;

// Unprotected routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/search/{name}', [UserController::class, 'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/rents', [RentalController::class, 'index']);
    Route::post('/rents', [RentalController::class, 'store']);
    Route::get('/rents/{id}', [RentalController::class, 'show']);
    Route::put('/rents/{id}', [RentalController::class, 'update']);
    Route::delete('/rents/{id}', [RentalController::class, 'destroy']);
    Route::get('/rents/search/{brand}', [RentalController::class, 'search']);
});
