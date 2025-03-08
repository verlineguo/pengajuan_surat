<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TUController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
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




require __DIR__.'/auth.php';
