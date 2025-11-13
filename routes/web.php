<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth_controller;
use App\Http\Controllers\pasien\pasien_controller;
use App\Http\Controllers\pasien\riwayat_pemeriksaan_controller;
use App\Http\Controllers\dokter\dokter_controller;
use App\Http\Controllers\dokter\rekam_medis_controller;
use App\Http\Controllers\dokter\reservasi_Controller_dokter;
use App\Http\Controllers\dokter\daftar_antrian_controller;
use App\Http\Controllers\dokter\daftar_pasien_controller;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/dbajax', function () {
    return view('pasien.dbpakeajax');
});

Route::get('/dashboardtest', function (){
    return view('pasien.dashboardtest');
});

Route::get('/dashboarddok', function (){
    return view('dokter.dashboard');
});

// Biodata
Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')->name('pasien.')
    ->group(function () {
        Route::get('/dashboard', [pasien_controller::class, 'dashboard'])->name('dashboard');
        Route::get('/biodata/tambah', [pasien_controller::class, 'tambah_biodata'])->name('tambah_biodata');
        Route::post('/biodata/simpan', [pasien_controller::class, 'simpan_biodata'])->name('simpan_biodata');
        Route::get('/biodata/{id}/edit', [pasien_controller::class, 'edit_biodata'])->name('edit_biodata');
        Route::put('/biodata/{id}', [pasien_controller::class, 'update_biodata'])->name('update_biodata');
        Route::delete('/biodata/{id}', [pasien_controller::class, 'hapus_biodata'])->name('hapus_biodata');
        Route::post('/ganti-profil/{id}', [pasien_controller::class, 'ganti_profil'])->name('ganti_profil');
        
        Route::get('/riwayat', [riwayat_pemeriksaan_controller::class, 'riwayat_pemeriksaan'])->name('riwayat');
        Route::get('/riwayat/{reservasiId}/detail', [riwayat_pemeriksaan_controller::class, 'detail'])->name('riwayat.detail');
        Route::get('/riwayat-pemeriksaan', [riwayat_pemeriksaan_controller::class, 'riwayat_pemeriksaan'])->name('riwayat');
        
        Route::get('/reservasi', [App\Http\Controllers\Pasien\reservasi_controller::class, 'index_reservasi'])->name('index_reservasi');
        Route::post('/reservasi', [App\Http\Controllers\Pasien\reservasi_controller::class, 'buat_reservasi'])->name('buat_reservasi');
        Route::post('/reservasi/{id}/cancel', [App\Http\Controllers\Pasien\reservasi_controller::class, 'batalkan_reservasi'])->name('batalkan_reservasi');
        Route::get('/reservasi/riwayat', [App\Http\Controllers\Pasien\reservasi_controller::class, 'riwayat_reservasi'])->name('riwayat_reservasi');

        
});


// Dashboard Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')
->group(function () {
    // Dashboard
    Route::get('/dashboard', [dokter_controller::class, 'dashboard'])
        ->name('dashboard');
    Route::put('/jadwal', [dokter_controller::class, 'update_jadwal'])
        ->name('update.jadwal');
    Route::get('/daftar-antrian', [daftar_antrian_controller::class, 'daftar_antrian'])
        ->name('daftar_antrian');
    Route::get('/reservasi/{id}/detail', [daftar_antrian_controller::class, 'detail_reservasi'])
        ->name('reservasi.detail');

    Route::patch('/reservasi/{reservasi}/periksa', [reservasi_controller_dokter::class, 'mark_periksa'])
        ->name('reservasi.periksa');
    
    Route::get('/profil/edit', [dokter_controller::class, 'edit_profil'])
            ->name('profil.edit');

    Route::put('/profil/update', [dokter_controller::class, 'update_profil'])
        ->name('profil.update');

    Route::get('/sip/download', [dokter_controller::class, 'download_sip'])
        ->name('sip.download');

    Route::get('/daftar-pasien/riwayat-rekam-medis', [rekam_medis_controller::class, 'riwayat_rekam_medis'])
        ->name('riwayat_rekam_medis');
    Route::get('/reservasi/{reservasi}/rekam-medis/buat', [rekam_medis_controller::class, 'buat_rekam_medis'])
        ->name('buat_rekam_medis'); 
    Route::post('/reservasi/{reservasi}/rekam-medis', [rekam_medis_controller::class, 'simpan_rekam_medis'])
        ->name('simpan_rekam_medis');
    
    
    Route::get('/daftar-pasien', [daftar_pasien_controller::class, 'daftar_pasien'])
        ->name('daftar_pasien');
    Route::get('/pasien/{id}/detail', [daftar_pasien_controller::class, 'detail_pasien'])
        ->name('pasien.detail');
        

    Route::get('/laporan', [App\Http\Controllers\Dokter\laporan_controller::class, 'laporan'])
        ->name('laporan');

    Route::get('/rekam-medis/{id}/detail', [App\Http\Controllers\Dokter\laporan_controller::class, 'detail_rekam_medis'])
        ->name('rekam_medis.detail');   
});



Route::get('/login', [auth_controller::class, 'tampilkan_login'])->name('login');
Route::post('/login', [auth_controller::class, 'login'])->middleware('guest')->name('login.post');

// Register (khusus pasien)
Route::get('/register', [auth_controller::class, 'tampilkan_register'])->name('register');
Route::post('/register', [auth_controller::class, 'register'])->name('register.post');


// Logout (harus sudah login)
Route::post('/logout', [auth_controller::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// Dashboard Resepsionis
Route::middleware(['auth', 'role:resepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', function () {
        return view('resepsionis.dashboard');
    })->name('dashboard');
});
