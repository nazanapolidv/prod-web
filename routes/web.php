<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('home', function () {
    return view('welcome');
})->name('home');

Route::get('registro', function () {
    return view('register');
})->name('registro');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('mi-salud', function () {
    return view('mi-salud');
})->name('mi-salud');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
