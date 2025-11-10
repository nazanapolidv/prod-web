<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MiHistorialController;
use App\Http\Controllers\MisCitasController;
use App\Http\Controllers\MiSaludController;
use App\Http\Controllers\MiPerfilController;
use App\Http\Controllers\TurnoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/turnos', [TurnoController::class, 'store'])->name('turnos.store');
    Route::delete('/turnos/{turno}', [TurnoController::class, 'destroy'])->name('turnos.destroy');
    Route::get('/turnos/medicos/{especialidad}', [TurnoController::class, 'medicos'])->name('turnos.medicos');
    Route::get('/turnos/horarios', [TurnoController::class, 'horarios'])->name('turnos.horarios');
    Route::get('/mis-citas', [TurnoController::class, 'index'])->name('mis-citas');
    Route::get('mi-salud', [MiSaludController::class, 'index'])->name('mi-salud');
    Route::get('mi-perfil', function () {
        return view('mi-perfil');
    })->name('mi-perfil');
    Route::put('/perfil/actualizar', [MiPerfilController::class, 'actualizar'])->name('perfil.actualizar');
    Route::get('/mi-historial', [MiHistorialController::class, 'index'])->name('mi-historial');
    Route::get('/solicitar-turno', [TurnoController::class, 'create'])->name('turnos.create');
    Route::view('profile', 'profile')->name('profile');
});

Route::get('mi-agenda', function () {
    return view('mi-agenda');
})->name('mi-agenda');
Route::get('/administrador/abm', function () {
    return view('abm');
})->name('administrador.abm');
Route::get('registro', function () {
    return view('register');
})->name('registro');
Route::get('login', function () {
    return view('login');
})->name('login');
Route::get('contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::get('test-register', App\Livewire\TestRegister::class)->name('test-register');
Route::get('test-livewire', function () {
    return view('test-livewire');
})->name('test-livewire');
Route::get('debug-livewire', function () {
    return view('debug-livewire');
})->name('debug-livewire');

require __DIR__ . '/auth.php';
