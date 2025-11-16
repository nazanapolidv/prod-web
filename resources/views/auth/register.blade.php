@extends('layouts.guest')

@section('content')
<div>
    @if ($errors->any())
    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;">
        <strong>Por favor corrige los siguientes errores:</strong>
        <ul style="margin: 10px 0 0 20px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container_registro">
        <div class="main_image">
            <a href="{{route('home')}}" class="logo flex justify-center items-center w-auto">
                <img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Hospital Polaco" />
            </a>
        </div>

        <div class="form_group">
            <h1 class="title">Registrarse</h1>
        </div>

        <div class="container_form">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form_group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Juan" required />
                </div>

                <div class="form_group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" placeholder="Perez" required />
                </div>

                <div class="form_group">
                    <label for="tipo_doc">Tipo de documento</label>
                    <select name="tipo_doc" id="tipo_doc" required>
                        <option value="" disabled {{ old('tipo_doc') ? '' : 'selected' }}>Selecciona</option>
                        <option value="dni" {{ old('tipo_doc') == 'dni' ? 'selected' : '' }}>DNI</option>
                        <option value="pasaporte" {{ old('tipo_doc') == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="cedula" {{ old('tipo_doc') == 'cedula' ? 'selected' : '' }}>Cédula de identidad</option>
                    </select>
                </div>

                <div class="form_group">
                    <label for="documento">Numero de documento</label>
                    <input type="text" id="documento" name="documento" value="{{ old('documento') }}" placeholder="Ej: 12345678" required />
                </div>

                <div class="form_group">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" required>
                        <option value="" disabled {{ old('genero') ? '' : 'selected' }}>Selecciona</option>
                        <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="O" {{ old('genero') == 'O' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="form_group">
                    <label for="fecha_nac">Fecha de nacimiento</label>
                    <input type="date" id="fecha_nac" name="fecha_nac" value="{{ old('fecha_nac') }}" required />
                </div>

                <div class="form_group">
                    <label for="telefono">Celular</label>
                    <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="011 2230 4880" required />
                </div>

                <div class="form_group">
                    <label for="email">Mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@gmail.com" required />
                </div>

                <div class="form_group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required />
                </div>

                <div class="form_group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required />
                </div>

                <button type="submit" class="primary_button">Registrarse</button>
            </form>
        </div>
    </div>
</div>
@endsection