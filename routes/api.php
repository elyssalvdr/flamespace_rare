<?php

use App\Http\Controllers\Admin\RoomsController;
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

//dashboard
Route::get('/dashboard', 'DashboardController@index');

//users
Route::get('/users', 'UserController@index');
Route::get('/users/search', 'UserController@search');
Route::post('/users/add', 'UserController@store');
Route::delete('/users/{id}', 'UserController@destroy');
Route::put('/users/{id}', 'UserController@update');

//rooms
Route::get('/rooms', 'RoomController@index');
Route::get('/rooms/filter/{building}', 'RoomController@filterByBuilding');
Route::post('/rooms/add', 'RoomController@store');
Route::get('/rooms/{id}', 'RoomController@show');
Route::delete('/rooms/{id}', 'RoomController@destroy');
Route::put('/rooms/{id}', 'RoomController@update');

//schedules
Route::get('/schedules', 'ScheduleController@index');
Route::get('/schedules/filter/{room}', 'ScheduleController@filterByRoom');
Route::post('/schedules/add', 'ScheduleController@store');
Route::get('/schedules/{id}', 'ScheduleController@show');
Route::delete('/schedules/{id}', 'ScheduleController@destroy');
Route::put('/schedules/{id}', 'ScheduleController@update');

//calendar
Route::get('/calendar', 'CalendarController@index');
Route::get('/calendar/filter', 'CalendarController@filter');