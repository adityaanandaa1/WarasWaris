<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth_controller;
use App\Http\Controllers\pasien\pasien_controller;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/layanan', function () {
    return view('homepage.layanan');
});

Route::get('/ajakan', function () {
    return view('homepage.ajakan');
});

Route::get('/alamat', function () {
    return view('homepage.alamat');
});

Route::get('/jadwal', function () {
    return view('homepage.jadwal');
});

Route::get('/aboutus', function () {
    return view('homepage.aboutus');
});

Route::get('/dbajax', function () {
    return view('pasien.dbpakeajax');
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
        
        Route::get('/reservasi', [App\Http\Controllers\Pasien\reservasi_controller::class, 'index_reservasi'])->name('index_reservasi');
        Route::post('/reservasi', [App\Http\Controllers\Pasien\reservasi_controller::class, 'buat_reservasi'])->name('buat_reservasi');
        Route::post('/reservasi/{id}/cancel', [App\Http\Controllers\Pasien\reservasi_controller::class, 'batalkan_reservasi'])->name('batalkan_reservasi');
        Route::get('/reservasi/riwayat', [App\Http\Controllers\Pasien\reservasi_controller::class, 'riwayat_reservasi'])->name('riwayat_reservasi');
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

// Dashboard Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dashboard');
});

// Dashboard Resepsionis
Route::middleware(['auth', 'role:resepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', function () {
        return view('resepsionis.dashboard');
    })->name('dashboard');
});

