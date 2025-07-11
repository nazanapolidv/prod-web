@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/registro.css'])
<div>
  @if (session('debug'))
    <div style="background: yellow; padding: 10px; margin: 10px; border: 1px solid red;">
      <strong>DEBUG:</strong> {{ session('debug') }}
    </div>
  @endif
  
  @if ($errors->any())
    <div style="background: red; color: white; padding: 10px; margin: 10px;">
      <strong>Errores:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
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
      <button type="button" wire:click="testButton" style="background: blue; color: white; padding: 5px 10px; margin: 10px;">
        Test Livewire
      </button>
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
          <input wire:model="documento" placeholder="Ej: 12345678" type="text" id="documento" name="documento" required />
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
