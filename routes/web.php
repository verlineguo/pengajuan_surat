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
use App\Http\Controllers\ProdiController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/{role}/profile', [ProfileController::class, 'profile'])
        ->where('role', 'admin|tu|kaprodi|mahasiswa')
        ->name('profile');
    Route::put('/{role}/profile/update', [ProfileController::class, 'updateProfile'])
        ->where('role', 'admin|tu|kaprodi|mahasiswa')
        ->name('profile.update');
});

Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin.dashboard');

        });
        Route::controller(UserController::class)->group(function() {
            Route::get('/karyawan', 'indexKaryawan')->name('admin.karyawan');
            Route::get('/karyawan/create', 'createKaryawan')->name('admin.karyawan.create');
            Route::post('/karyawan/store', 'storeKaryawan')->name('admin.karyawan.store');
            Route::get('/karyawan/{nomor_induk}', 'showKaryawan')->name('admin.karyawan.show');
            Route::get('/karyawan/edit/{nomor_induk}', 'editKaryawan')->name('admin.karyawan.edit');
            Route::put('/karyawan/update/{nomor_induk}', 'updateKaryawan')->name('admin.karyawan.update');
            Route::delete('/karyawan/delete/{nomor_induk}', 'destroyKaryawan')->name('admin.karyawan.delete');
            Route::get('/mahasiswa', 'indexMahasiswa')->name('admin.mahasiswa');
            Route::get('/mahasiswa/create', 'createMahasiswa')->name('admin.mahasiswa.create');
            Route::post('/mahasiswa/store', 'storeMahasiswa')->name('admin.mahasiswa.store');
            Route::get('/mahasiswa/{nomor_induk}', 'showMahasiswa')->name('admin.mahasiswa.show');
            Route::get('/mahasiswa/edit/{nomor_induk}', 'editMahasiswa')->name('admin.mahasiswa.edit');
            Route::put('/mahasiswa/update/{nomor_induk}', 'updateMahasiswa')->name('admin.mahasiswa.update');
            Route::delete('/mahasiswa/delete/{nomor_induk}', 'destroyMahasiswa')->name('admin.mahasiswa.delete');

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

     
    });
    
});

Route::middleware(['auth', 'verified', 'rolemanager:tu'])->group(function () {
    Route::prefix('tu')->group(function() {
        Route::controller(TUController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('tu.dashboard');
        });

        Route::controller(TUPengajuanController::class)->group(function() {
            Route::get('/pengajuan', 'index')->name('tu.pengajuan');
            Route::get('/pengajuan/{id_pengajuan}', 'show')->name('tu.pengajuan.show');
            Route::get('/pengajuan/edit/{id_pengajuan}', 'edit')->name('tu.pengajuan.edit');
            Route::put('/pengajuan/update/{id_pengajuan}', 'update')->name('tu.pengajuan.update');
            Route::post('/pengajuan/{id_pengajuan}/upload', 'uploadSurat')->name('tu.pengajuan.upload');
        });

        Route::controller(UserController::class)->group(function() {
           
            Route::put('/user/update/{nomor_induk}', 'update')->name('tu.user.update');

        });
        
    });
        
});

Route::middleware(['auth', 'verified', 'rolemanager:kaprodi'])->group(function () {
    Route::prefix('kaprodi')->group(function() {
        Route::controller(KaprodiController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('kaprodi.dashboard');

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
