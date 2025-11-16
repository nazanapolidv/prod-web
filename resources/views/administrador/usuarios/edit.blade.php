<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Usuario</title>
    @vite(['resources/css/app.css', 'resources/css/abm.css', 'resources/css/usuarios.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <h1 class="title">Editar Usuario</h1>

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
                <form method="POST" action="{{ route('administrador.usuarios.update', $usuario) }}" class="usuario-form">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form_group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre', $usuario->nombre) }}" required>
                            @error('nombre')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="apellido">Apellido *</label>
                            <input type="text" id="apellido" name="apellido"
                                value="{{ old('apellido', $usuario->apellido) }}" required>
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
                                <option value="dni" {{ old('tipo_doc', $usuario->tipo_doc) == 'dni' ? 'selected' : '' }}>DNI</option>
                                <option value="pasaporte" {{ old('tipo_doc', $usuario->tipo_doc) == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                <option value="cedula" {{ old('tipo_doc', $usuario->tipo_doc) == 'cedula' ? 'selected' : '' }}>Cédula</option>
                            </select>
                            @error('tipo_doc')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="documento">Número de Documento *</label>
                            <input type="text" id="documento" name="documento"
                                value="{{ old('documento', $usuario->documento) }}" required>
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
                                <option value="masculino" {{ old('genero', $usuario->genero) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="femenino" {{ old('genero', $usuario->genero) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="no-binario" {{ old('genero', $usuario->genero) == 'no-binario' ? 'selected' : '' }}>No-binario</option>
                            </select>
                            @error('genero')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="fecha_nac">Fecha de Nacimiento *</label>
                            <input type="date" id="fecha_nac" name="fecha_nac"
                                value="{{ old('fecha_nac', $usuario->fecha_nac->format('Y-m-d')) }}" required>
                            @error('fecha_nac')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="telefono">Teléfono *</label>
                            <input type="text" id="telefono" name="telefono"
                                value="{{ old('telefono', $usuario->telefono) }}" required>
                            @error('telefono')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', $usuario->email) }}" required>
                            @error('email')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" id="password" name="password"
                                minlength="8">
                            <small>Dejar en blanco para mantener la contraseña actual. Mínimo 8 caracteres si se cambia.</small>
                            @error('password')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="rol">Rol *</label>
                            @if(auth()->id() === $usuario->id)
                            <input type="text"
                                value="{{ ucfirst($usuario->rol) }}"
                                disabled
                                style="background-color: #f5f5f5; cursor: not-allowed;">
                            <input type="hidden" name="rol" value="{{ $usuario->rol }}">
                            <small style="color: #666; display: block; margin-top: 5px;">
                                No puedes cambiar tu propio rol
                            </small>
                            @else
                            <select id="rol" name="rol" required>
                                <option value="">Seleccione...</option>
                                <option value="paciente" {{ old('rol', $usuario->rol) == 'paciente' ? 'selected' : '' }}>Paciente</option>
                                <option value="medico" {{ old('rol', $usuario->rol) == 'medico' ? 'selected' : '' }}>Médico</option>
                                <option value="administrador" {{ old('rol', $usuario->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            </select>
                            @endif
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
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>