<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentedController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\OverdueController;

// Unauthenticated users
//! TODO: Repository pattern here
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticatd users
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/rent', [RentController::class, 'index']);
    Route::post('/rent', [RentController::class, 'store']);
});

// Admins
Route::group(['middleware' => ['auth:sanctum', 'CheckAdmin']], function () {
    //! TODO: Repository pattern here
    Route::get('/rented', [RentedController::class, 'index']);
    Route::get('/rented/{rent}', [RentedController::class, 'show']);
    Route::put('/rented/{rent}', [RentedController::class, 'update']);
    Route::delete('/rented/{rent}', [RentedController::class, 'destroy']);
    Route::get('/rented/search/{brand}', [RentedController::class, 'search']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::get('/users/search/{name}', [UserController::class, 'search']);

    //! TODO: Repository pattern here
    Route::get('/overdue', [OverdueController::class, 'index']);
});
