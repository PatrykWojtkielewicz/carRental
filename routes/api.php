<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentedController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\OverdueController;

// Unauthenticated users
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
    Route::get('/rented', [RentedController::class, 'index']);
    Route::get('/rented/{id}', [RentedController::class, 'show']);
    Route::put('/rented/{id}', [RentedController::class, 'update']);
    Route::delete('/rented/{id}', [RentedController::class, 'destroy']);
    Route::get('/rented/search/{brand}', [RentedController::class, 'search']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/search/{name}', [UserController::class, 'search']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/overdue', [OverdueController::class, 'index']);
});
