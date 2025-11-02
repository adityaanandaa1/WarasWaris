<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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