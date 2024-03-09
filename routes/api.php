<?php

use App\Http\Controllers\RoomsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Admin\FullCalendarController;

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
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Public routes of authentication 
Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users/search', [UserController::class, 'search']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Rooms
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::get('/rooms/filter/{building}', [RoomController::class, 'filterByBuilding']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

// Schedules
Route::get('/schedules', [ScheduleController::class, 'index']);
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
Route::get('/schedules/filter/{room}', [RoomController::class, 'filterByRoom']);
Route::post('/schedules', [ScheduleController::class, 'store']);
Route::put('/schedules/{id}', [ScheduleController::class, 'update']);
Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);

// Calendar
Route::get('/api/events', [FullCalendarController::class, 'getEvents']);
