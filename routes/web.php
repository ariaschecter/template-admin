<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IKU1Controller;
use App\Http\Controllers\IKU2Controller;
use App\Http\Controllers\IKU3Controller;
use App\Http\Controllers\IKU4Controller;
use App\Http\Controllers\IKU5Controller;
use App\Http\Controllers\IKU6Controller;
use App\Http\Controllers\IKU7Controller;
use App\Http\Controllers\IKU8Controller;
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
        Route::get('/show-file/{path}/{id}', 'show_file')->name('show_file');
    });


    // Admin routes
    Route::middleware('role:admin', 'auth')->prefix('admin')->name('admin.')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'admin')->name('dashboard');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

        Route::prefix('iku-1')->name('iku-1.')->group(function () {
            Route::get('/', [IKU1Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU1Controller::class, 'print'])->name('print');
            Route::post('/', [IKU1Controller::class, 'store'])->name('store');
            Route::put('/{iku1}', [IKU1Controller::class, 'update'])->name('update');
            Route::delete('/{iku1}', [IKU1Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-2')->name('iku-2.')->group(function () {
            Route::get('/', [IKU2Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU2Controller::class, 'print'])->name('print');
            Route::post('/', [IKU2Controller::class, 'store'])->name('store');
            Route::put('/{iku2}', [IKU2Controller::class, 'update'])->name('update');
            Route::delete('/{iku2}', [IKU2Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-3')->name('iku-3.')->group(function () {
            Route::get('/', [IKU3Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU3Controller::class, 'print'])->name('print');
            Route::post('/', [IKU3Controller::class, 'store'])->name('store');
            Route::put('/{iku3}', [IKU3Controller::class, 'update'])->name('update');
            Route::delete('/{iku3}', [IKU3Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-4')->name('iku-4.')->group(function () {
            Route::get('/', [IKU4Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU4Controller::class, 'print'])->name('print');
            Route::post('/', [IKU4Controller::class, 'store'])->name('store');
            Route::put('/{iku4}', [IKU4Controller::class, 'update'])->name('update');
            Route::delete('/{iku4}', [IKU4Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-5')->name('iku-5.')->group(function () {
            Route::get('/', [IKU5Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU5Controller::class, 'print'])->name('print');
            Route::post('/', [IKU5Controller::class, 'store'])->name('store');
            Route::put('/{iku5}', [IKU5Controller::class, 'update'])->name('update');
            Route::delete('/{iku5}', [IKU5Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-6')->name('iku-6.')->group(function () {
            Route::get('/', [IKU6Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU6Controller::class, 'print'])->name('print');
            Route::post('/', [IKU6Controller::class, 'store'])->name('store');
            Route::put('/{iku6}', [IKU6Controller::class, 'update'])->name('update');
            Route::delete('/{iku6}', [IKU6Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-7')->name('iku-7.')->group(function () {
            Route::get('/', [IKU7Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU7Controller::class, 'print'])->name('print');
            Route::post('/', [IKU7Controller::class, 'store'])->name('store');
            Route::put('/{iku7}', [IKU7Controller::class, 'update'])->name('update');
            Route::delete('/{iku7}', [IKU7Controller::class, 'destroy'])->name('destroy');
        });
        Route::prefix('iku-8')->name('iku-8.')->group(function () {
            Route::get('/', [IKU8Controller::class, 'index'])->name('index');
            Route::get('/cetak', [IKU8Controller::class, 'print'])->name('print');
            Route::post('/', [IKU8Controller::class, 'store'])->name('store');
            Route::put('/{iku8}', [IKU8Controller::class, 'update'])->name('update');
            Route::delete('/{iku8}', [IKU8Controller::class, 'destroy'])->name('destroy');
        });

        Route::resource('user', UserController::class);
    });
});

require __DIR__ . '/auth.php';
