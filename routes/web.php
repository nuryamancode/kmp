<?php

use App\Http\Controllers\Auth\Authentice;
use App\Http\Controllers\Menu\KelolaUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['guest'])->group(function () {

    Route::get('/', [Authentice::class, 'showLoginForm'])->name('login');
    Route::get('/login', [Authentice::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Authentice::class, 'store'])->name('login.store');

});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [Authentice::class, 'logout'])->name('logout');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('kelolauser')->name('kelolauser.')->group(function () {
        Route::resource('', KelolaUser::class)->parameters(['' => 'user']);
    });

});
