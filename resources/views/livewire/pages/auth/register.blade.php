<?php

use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
  public string $nombre = '';
  public string $apellido = '';
  public string $tipo_doc = '';
  public string $documento = '';
  public string $genero = '';
  public string $fecha_nac = '';
  public string $telefono = '';
  public string $email = '';
  public string $password = '';
  public string $password_confirmation = '';

  public function register(): void
  {
    $validated = $this->validate([
      'nombre' => 'required|string|max:255',
      'apellido' => 'required|string|max:255',
      'tipo_doc' => 'required|string',
      'documento' => 'required|numeric',
      'genero' => 'required|string',
      'fecha_nac' => 'required|date',
      'telefono' => 'required|string|max:20',
      'email' => 'required|email|max:255|unique:usuarios,email',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $validated['rol'] = 'paciente'; // Rol por defecto

    $user = Usuario::create($validated);

    event(new Registered($user));
    Auth::login($user);

    $this->redirect(route('dashboard'), navigate: true);
  }
};
?>
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/registro.css'])
<div>
  <div class="container_registro">
    <div class="main_image">
      <a href="{{route('home')}}" class="logo flex justify-center items-center w-auto">
        <img
          src="{{ Vite::asset('resources/assets/logo.png') }}"
          alt="Hospital Polaco" />
      </a>
    </div>
    <div class="form_group">
      <h1 class="title">Registrarse</h1>
    </div>
    <div class="container_form">
      <form wire:submit.prevent="register">
        <div class="form_group">
          <label for="nombre">Nombre</label>
          <input wire:model="nombre" placeholder="Juan" type="text" id="nombre" name="nombre" required />
        </div>

        <div class="form_group">
          <label for="apellido">Apellido</label>
          <input wire:model="apellido" placeholder="Perez" type="text" id="apellido" name="apellido" required />
        </div>

        <div class="form_group">
          <label for="tipo_doc">Tipo de documento</label>
          <select wire:model="tipo_doc" name="tipo_doc" id="tipo_doc" required>
            <option value="" disabled selected>Selecciona</option>
            <option value="dni">DNI</option>
            <option value="pasaporte">Pasaporte</option>
            <option value="cedula">Cédula de identidad</option>
          </select>
        </div>

        <div class="form_group">
          <label for="documento">Numero de documento</label>
          <input wire:model="documento" placeholder="Ej: 12345678" type="number" id="documento" name="documento" required />
        </div>

        <div class="form_group">
          <label for="genero">Género</label>
          <select wire:model="genero" name="genero" id="genero" required>
            <option value="" disabled selected>Selecciona</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="no-binario">No binario</option>
          </select>
        </div>

        <div class="form_group">
          <label for="fecha_nac">Fecha de nacimiento</label>
          <input wire:model="fecha_nac" type="date" id="fecha_nac" name="fecha_nac" required />
        </div>

        <div class="form_group">
          <label for="telefono">Celular</label>
          <input wire:model="telefono" placeholder="011 2230 4880" type="tel" id="telefono" name="telefono" required />
        </div>

        <div class="form_group">
          <label for="email">Mail</label>
          <input wire:model="email" placeholder="ejemplo@gmail.com" type="email" id="email" name="email" required />
        </div>

        <div class="form_group">
          <label for="password">Contraseña</label>
          <input wire:model="password" type="password" id="password" name="password" required />
        </div>

        <div class="form_group">
          <label for="password_confirmation">Confirmar contraseña</label>
          <input wire:model="password_confirmation" type="password" id="password_confirmation" name="password_confirmation" required />
        </div>

        <button type="submit" class="primary_button">Registrarse</button>
      </form>
    </div>
  </div>
</div>