<?php

use App\Http\Controllers\RoomsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes of authentication
Route::controller(LoginRegisterController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

// Public routes of rooms
Route::controller(RoomsController::class)->group(function () {
    Route::get('/rooms', 'index');
    Route::get('/rooms/{id}', 'show');
    Route::get('/rooms/search/{name}', 'search');
});

// Protected routes of rooms and logout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
    
    Route::controller(RoomsController::class)->group(function () {
        Route::post('/rooms', 'store');
        Route::post('/rooms/{id}', 'update');
        Route::delete('/rooms/{id}', 'destroy');
    });
});