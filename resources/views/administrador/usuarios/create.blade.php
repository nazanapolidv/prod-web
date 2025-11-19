<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Usuario</title>
    @vite(['resources/css/app.css', 'resources/css/abm.css', 'resources/css/usuarios.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <h1 class="title">Crear Nuevo Usuario</h1>

            @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-container">
                <form method="POST" action="{{ route('administrador.usuarios.store') }}" class="usuario-form">
                    @csrf

                    <div class="form-row">
                        <div class="form_group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre') }}" required>
                            @error('nombre')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="apellido">Apellido *</label>
                            <input type="text" id="apellido" name="apellido"
                                value="{{ old('apellido') }}" required>
                            @error('apellido')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="tipo_doc">Tipo de Documento *</label>
                            <select id="tipo_doc" name="tipo_doc" required>
                                <option value="">Seleccione...</option>
                                <option value="dni" {{ old('tipo_doc') == 'dni' ? 'selected' : '' }}>DNI</option>
                                <option value="pasaporte" {{ old('tipo_doc') == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                <option value="cedula" {{ old('tipo_doc') == 'cedula' ? 'selected' : '' }}>Cédula</option>
                            </select>
                            @error('tipo_doc')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="documento">Número de Documento *</label>
                            <input type="text" id="documento" name="documento"
                                value="{{ old('documento') }}" required>
                            @error('documento')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="genero">Género *</label>
                            <select id="genero" name="genero" required>
                                <option value="">Seleccione...</option>
                                <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                                <option value="O" {{ old('genero') == 'O' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="fecha_nac">Fecha de Nacimiento *</label>
                            <input type="date" id="fecha_nac" name="fecha_nac"
                                value="{{ old('fecha_nac') }}" required>
                            @error('fecha_nac')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="telefono">Teléfono *</label>
                            <input type="text" id="telefono" name="telefono"
                                value="{{ old('telefono') }}" required>
                            @error('telefono')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="password">Contraseña *</label>
                            <input type="password" id="password" name="password"
                                minlength="8" required>
                            <small>Mínimo 8 caracteres</small>
                            @error('password')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="rol">Rol *</label>
                            <select id="rol" name="rol" required>
                                <option value="">Seleccione...</option>
                                <option value="paciente" {{ old('rol') == 'paciente' ? 'selected' : '' }}>Paciente</option>
                                <option value="medico" {{ old('rol') == 'medico' ? 'selected' : '' }}>Médico</option>
                                <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            </select>
                            @error('rol')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form_buttons">
                        <a href="{{ route('administrador.usuarios.index') }}" class="secondary_button">
                            Cancelar
                        </a>
                        <button type="submit" class="primary_button">
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>