<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TUController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
        });
        Route::controller(UserController::class)->group(function() {
            Route::get('/user', 'index')->name('admin.user');
            Route::get('/user/create', 'create')->name('admin.user.create');
            Route::post('/user/store', 'store')->name('admin.user.store');
            Route::get('/user/{id}', 'show')->name(name: 'admin.user.show');
            Route::get('/user/edit/{id}', 'edit')->name('admin.user.edit');
            Route::put('/user/update/{id}', 'update')->name('admin.user.update');
            Route::delete('/user/delete/{id}', 'destroy')->name('admin.user.delete');
        });

    });
    
});

Route::middleware(['auth', 'verified', 'rolemanager:tu'])->group(function () {
    Route::prefix('tu')->group(function() {
        Route::controller(TUController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('tu.dashboard');
        });


    });
});

Route::middleware(['auth', 'verified', 'rolemanager:kaprodi'])->group(function () {
    Route::prefix('kaprodi')->group(function() {
        Route::controller(KaprodiController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('kaprodi.dashboard');
        });
    });
});

Route::middleware(['auth', 'verified', 'rolemanager:mahasiswa'])->group(function () {
    Route::prefix('mahasiswa')->group(function() {
        Route::controller(MahasiswaController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('mahasiswa.dashboard');
        });
    });
});



require __DIR__.'/auth.php';
