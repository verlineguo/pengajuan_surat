<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Kaprodi\KaprodiPengajuanController;
use App\Http\Controllers\TU\PengajuanController as TUPengajuanController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TUController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
            Route::get('/profile', 'profile')->name('admin.profile');

        });
        Route::controller(UserController::class)->group(function() {
            Route::get('/user', 'index')->name('admin.user');
            Route::get('/user/create', 'create')->name('admin.user.create');
            Route::post('/user/store', 'store')->name('admin.user.store');
            Route::get('/user/{nomor_induk}', 'show')->name(name: 'admin.user.show');
            Route::get('/user/edit/{nomor_induk}', 'edit')->name('admin.user.edit');
            Route::put('/user/update/{nomor_induk}', 'update')->name('admin.user.update');
            Route::delete('/user/delete/{nomor_induk}', 'destroy')->name('admin.user.delete');
        });

        Route::controller(MataKuliahController::class)->group(function() {
            Route::get('/matakuliah', 'index')->name('admin.matakuliah');
            Route::get('/matakuliah/create', 'create')->name('admin.matakuliah.create');
            Route::post('/matakuliah/store', 'store')->name('admin.matakuliah.store');
            Route::get('/matakuliah/{id}', 'show')->name(name: 'admin.matakuliah.show');
            Route::get('/matakuliah/edit/{id}', 'edit')->name('admin.matakuliah.edit');
            Route::put('/matakuliah/update/{id}', 'update')->name('admin.matakuliah.update');
            Route::delete('/matakuliah/delete/{id}', 'destroy')->name('admin.matakuliah.delete');
        });

        Route::controller(SuratController::class)->group(function() {
            Route::get('/surat', 'index')->name('admin.surat');
            Route::get('/surat/create', 'create')->name('admin.surat.create');
            Route::post('/surat/store', 'store')->name('admin.surat.store');
            Route::get('/surat/{id}', 'show')->name(name: 'admin.surat.show');
            Route::get('/surat/edit/{id}', 'edit')->name('admin.surat.edit');
            Route::put('/surat/update/{id}', 'update')->name('admin.surat.update');
            Route::delete('/surat/delete/{id}', 'destroy')->name('admin.surat.destroy');

        });

        

    });
    
});

Route::middleware(['auth', 'verified', 'rolemanager:tu'])->group(function () {
    Route::prefix('tu')->group(function() {
        Route::controller(TUController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('tu.dashboard');
            Route::get('/profile', 'profile')->name('tu.profile');
            Route::put('/user/update/{nomor_induk}', 'updateProfile')->name('tu.user.update');
        });

        Route::controller(TUPengajuanController::class)->group(function() {
            Route::get('/pengajuan', 'index')->name('tu.pengajuan');
            Route::get('/pengajuan/{id_pengajuan}', 'show')->name('tu.pengajuan.show');
            Route::get('/pengajuan/edit/{id_pengajuan}', 'edit')->name('tu.pengajuan.edit');
            Route::put('/pengajuan/update/{id_pengajuan}', 'update')->name('tu.pengajuan.update');
            Route::post('/pengajuan/{id_pengajuan}/upload', 'uploadSurat')->name('tu.pengajuan.upload');
        });


    });
});

Route::middleware(['auth', 'verified', 'rolemanager:kaprodi'])->group(function () {
    Route::prefix('kaprodi')->group(function() {
        Route::controller(KaprodiController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('kaprodi.dashboard');
            Route::get('/profile', 'profile')->name('kaprodi.profile');
            Route::put('/user/update/{nomor_induk}', 'updateProfile')->name('kaprodi.user.update');

        });
        Route::controller(KaprodiPengajuanController::class)->group(function() {
            Route::get('/pengajuan', 'index')->name('kaprodi.pengajuan');
            Route::get('/pengajuan/{id_pengajuan}', 'show')->name('kaprodi.pengajuan.show');
            Route::get('/pengajuan/edit/{id_pengajuan}', 'edit')->name('kaprodi.pengajuan.edit');
            Route::put('/pengajuan/update/{id_pengajuan}', 'update')->name('kaprodi.pengajuan.update');
            Route::post('/pengajuan/{id_pengajuan}/approve', 'approve')->name('kaprodi.pengajuan.approve');
            Route::post('/pengajuan/{id_pengajuan}/reject', 'reject')->name('kaprodi.pengajuan.reject');
            Route::delete('/pengajuan/delete/{id_pengajuan}', 'destroy')->name('kaprodi.pengajuan.destroy');
        });
    });

    
});

Route::middleware(['auth', 'verified', 'rolemanager:mahasiswa'])->group(function () {
    Route::prefix('mahasiswa')->group(function() {
        Route::controller(MahasiswaController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('mahasiswa.dashboard');
            Route::get('/profile', 'profile')->name('mahasiswa.profile');
            Route::put('/user/update/{nomor_induk}', 'updateProfile')->name('mahasiswa.user.update');


        });
        Route::controller(PengajuanController::class)->group(function() {
            Route::get('/pengajuan', 'index')->name('mahasiswa.pengajuan.history');
            Route::get('/pengajuan/create', 'create')->name('mahasiswa.pengajuan');
            Route::post('/pengajuan/store', 'store')->name('mahasiswa.pengajuan.store');
            Route::get('/pengajuan/show/{id_pengajuan}', 'show')->name('mahasiswa.pengajuan.show');
            Route::get('/pengajuan/edit/{id_pengajuan}', 'edit')->name('mahasiswa.pengajuan.edit');
            Route::put('/pengajuan/update/{id_pengajuan}', 'update')->name('mahasiswa.pengajuan.update');
            Route::delete('/pengajuan/delete/{id_pengajuan}', 'destroy')->name('mahasiswa.pengajuan.destroy');
            

        });
    });
    
});



require __DIR__.'/auth.php';
