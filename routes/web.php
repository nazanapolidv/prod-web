<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MiHistorialController;
use App\Http\Controllers\MisCitasController;
use App\Http\Controllers\MiSaludController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Temporary redirect from dashboard to home
Route::get('dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::middleware('auth')->get('/mis-citas', [MisCitasController::class, 'index'])
    ->name('mis-citas');

Route::get('mi-salud', [MiSaludController::class, 'index'])
    ->middleware('auth')
    ->name('mi-salud');

Route::get('mi-agenda', function () {
    return view('mi-agenda');
})->name('mi-agenda');

Route::middleware(['auth'])->group(function () {
    Route::get('/mi-historial', [MiHistorialController::class, 'index'])
        ->name('mi-historial');
});

Route::get('abm', function () {
    return view('abm');
})->name('abm');

Route::get('registro', function () {
    return view('register');
})->name('registro');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('contacto', [ContactoController::class, 'index'])->name('contacto');

Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::get('mis-citas', function () {
    return view('mis-citas');
})->name('mis-citas');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('test-register', App\Livewire\TestRegister::class)->name('test-register');
Route::get('test-livewire', function () {
    return view('test-livewire');
})->name('test-livewire');
Route::get('debug-livewire', function () {
    return view('debug-livewire');
})->name('debug-livewire');

require __DIR__ . '/auth.php';
