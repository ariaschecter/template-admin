<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IKU1Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Language Change
Route::get('lang/{lang}', function ($lang) {
    if (array_key_exists($lang, Config::get('languages'))) {
        Session::put('applocale', $lang);
    }
    return redirect()->back();
})->name('lang');

Route::middleware('language')->group(function () {

    // Frontend routes
    Route::get('/', function () {
        return redirect('login');
    });

    // Dashboard routes
    Route::middleware('auth', 'verified')->controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // Admin routes
    Route::middleware('role:admin', 'auth')->prefix('admin')->name('admin.')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'admin')->name('dashboard');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

        Route::resource('iku-1', IKU1Controller::class);
        Route::resource('user', UserController::class);
    });
});

require __DIR__ . '/auth.php';
