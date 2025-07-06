<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('mis-citas', function () {
    return view('mis-citas');
})->name('mis-citas');

Route::get('mi-salud', function () {
    return view('mi-salud');
})->name('mi-salud');

Route::get('mi-agenda', function () {
    return view('mi-agenda');
})->name('mi-agenda');

Route::get('mi-historial', function () {
    return view('mi-historial');
})->name('mi-historial');

Route::get('abm', function () {
    return view('abm');
})->name('abm');

Route::get('prueba2', function () {
    return view('prueba2');
})->name('prueba2');

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

Route::get('mis-citas', function () {
    return view('mis-citas');
})->name('mis-citas');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
