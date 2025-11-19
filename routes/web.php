<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('main.home');
})->name('home');

Route::get('/about', function () {
    return view('main.about');
})->name('about');

Route::get('/activity', function () {
    return view('main.activity');
})->name('activity');

Route::get('/visitors', function () {
    return view('main.graphic');
})->name('visitors');

Route::get('/aspiration', function () {
    return view('main.aspiration');
})->name('aspiration');

Route::get('/profile', function () {
    return view('main.profile');
})->name('profile');

Route::get('/', function () {
    return view('main.loginpage');
})->name('login');

Route::get('/login-adm', function () {
    return view('login-role.login-admin');
})->name('login-adm');

Route::get('/login-mhs', function () {
    return view('login-role.login-mahasiswa');
})->name('login-mhs');

Route::get('/login-dosen', function () {
    return view('login-role.login-dosen');
})->name('login-dosen');