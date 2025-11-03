<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth_controller;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('homepage.home');
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


Route::get('/login', [auth_controller::class, 'tampilkan_login'])->name('login');
Route::post('/login', [auth_controller::class, 'login'])->middleware('guest')->name('login.post');

    // Register (khusus pasien)
    Route::get('/register', [auth_controller::class, 'tampilkan_register'])->name('register');
    Route::post('/register', [auth_controller::class, 'register'])->name('register.post');


// Logout (harus sudah login)
Route::post('/logout', [auth_controller::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('dashboard');
});