<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
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
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
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

        Route::prefix('application')->name('application.')->group(function () {
            Route::get('/', [ApplicationController::class, 'index'])->name('index');
        });

        Route::resource('user', UserController::class);
    });

    // Konsumen routes
    Route::middleware('role:konsumen', 'auth')->prefix('konsumen')->name('konsumen.')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'konsumen')->name('dashboard');
        });

        Route::prefix('application')->name('application.')->group(function () {
            Route::get('/', [ApplicationController::class, 'konsumenIndex'])->name('index');
            Route::get('/create', [ApplicationController::class, 'konsumenCreate'])->name('create');
            Route::post('/create', [ApplicationController::class, 'konsumenStore'])->name('create');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });

    // dealer routes
    Route::middleware('role:dealer', 'auth')->prefix('dealer')->name('dealer.')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'dealer')->name('dashboard');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });

    // marketing routes
    Route::middleware('role:marketing', 'auth')->prefix('marketing')->name('marketing.')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'marketing')->name('dashboard');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });

    // atasan routes
    Route::middleware('role:atasan', 'auth')->prefix('atasan')->name('atasan.')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'atasan')->name('dashboard');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });
});

require __DIR__ . '/auth.php';
