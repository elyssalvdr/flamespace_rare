<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomsController;



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

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
Route::get('/schedules', [SchedulesController::class, 'index'])->name('schedules');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('calendar', 'CalendarController@index')->name('calendar');


Route::resource('rooms', RoomsController::class);
Route::get('/admin/rooms', 'RoomsController@index')->name('admin.rooms.index');