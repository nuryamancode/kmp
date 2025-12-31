<?php

use App\Http\Controllers\Auth\Authentice;
use App\Http\Controllers\Menu\ArchiveController;
use App\Http\Controllers\Menu\CategoriesController;
use App\Http\Controllers\Menu\DivisionController;
use App\Http\Controllers\Menu\ManageUserController;
use App\Http\Controllers\Menu\ProfilController;
use App\Http\Controllers\Menu\StandardizationController;
use App\Http\Controllers\Menu\TypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ActivityLogController;

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['guest'])->group(function () {

    Route::get('/', [Authentice::class, 'showLoginForm'])->name('login');
    Route::get('/login', [Authentice::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Authentice::class, 'store'])->name('login.store');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [Authentice::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // ============== ADMIN & KEPALA SUBSKSI ==============
    Route::middleware(['permission:admin,kepsubseksi'])->group(function () {

        Route::prefix('kelolauser')->name('kelolauser.')->group(function () {
            Route::resource('', ManageUserController::class)->parameters(['' => 'user']);
        });

        Route::prefix('divisi')->name('divisi.')->group(function () {
            Route::resource('', DivisionController::class)->parameters(['' => 'divisi']);
        });
    });


    // ============== END ADMIN & KEPALA SUBSKSI ==============

    // ============== STAFF & PETUGAS ==============
    Route::middleware(['permission:staff,petugas'])->group(function () {

        Route::prefix('arsip')->name('arsip.')->group(function () {
            Route::resource('', ArchiveController::class)
                ->except('show')
                ->parameters(['' => 'user']);

            Route::get('arsip/{id}/show', [ArchiveController::class, 'show'])
                ->name('show');

            Route::middleware('permission:staff')->group(function () {
                Route::prefix('kategori')->name('kategori.')->group(function () {
                    Route::resource('', CategoriesController::class)
                        ->parameters(['' => 'kategori']);
                });
            });

            Route::middleware('permission:staff')->group(function () {
                Route::prefix('tipe')->name('tipe.')->group(function () {
                    Route::resource('', TypeController::class)
                        ->parameters(['' => 'tipe']);
                });
            });

            Route::middleware('permission:staff')->group(function () {
                Route::prefix('standarisasi')->name('standarisasi.')->group(function () {
                    Route::resource('', StandardizationController::class)
                        ->parameters(['' => 'standarisasi']);
                });
            });
        });
    });
    // ============== END STAFF & PETUGAS ============== 

    // Activity Log Route
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

    // Profil Route
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('', [ProfilController::class, 'index'])->name('index');
        Route::put('/update', [ProfilController::class, 'update'])->name('update');
        Route::put('/update-password', [ProfilController::class, 'updatePassword'])->name('update-password');
    });
});
