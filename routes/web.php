<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FullCalendarController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\UserController;
use App\http\Controllers\Admin\ScheduleController;
use App\http\Controllers\Admin\RoomController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('layouts.dashboard');
    Route::get('/home', [DashboardController::class, 'dashboard'])->name('layouts.dashboard');
    //users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //rooms
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    //sched
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{id}', [ScheduleController::class, 'show'])->name('schedules.show');
    Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    //calendar
    Route::get('/calendar', [FullCalendarController::class, 'calendar'])->name('calendar.index');

});


Auth::routes();
