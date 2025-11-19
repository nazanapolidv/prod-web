<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dar de Alta Empleado</title>
    @vite(['resources/css/app.css', 'resources/css/abm.css', 'resources/css/registros.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <h1 class="title">Dar de Alta Empleado</h1>

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
                <form method="POST" action="{{ route('administrador.registros.store') }}" class="empleado-form" id="formEmpleado">
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
                            <label for="documento">Documento *</label>
                            <input type="text" id="documento" name="documento"
                                value="{{ old('documento') }}" required>
                            @error('documento')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono"
                                value="{{ old('telefono') }}">
                            @error('telefono')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="tipo_empleado">Tipo de Empleado *</label>
                            <select id="tipo_empleado" name="tipo_empleado" required onchange="toggleCamposMedico()">
                                <option value="">Seleccione...</option>
                                <option value="medico" {{ old('tipo_empleado') == 'medico' ? 'selected' : '' }}>Médico</option>
                                <option value="enfermero" {{ old('tipo_empleado') == 'enfermero' ? 'selected' : '' }}>Enfermero</option>
                                <option value="administrativo" {{ old('tipo_empleado') == 'administrativo' ? 'selected' : '' }}>Administrativo</option>
                                <option value="mantenimiento" {{ old('tipo_empleado') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                            </select>
                            @error('tipo_empleado')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row" id="campos-medico" style="display: none;">
                        <div class="form_group">
                            <label for="nro_matricula">Número de Matrícula *</label>
                            <input type="text" id="nro_matricula" name="nro_matricula"
                                value="{{ old('nro_matricula') }}">
                            @error('nro_matricula')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form_group">
                            <label for="especialidad">Especialidad *</label>
                            <select id="especialidad" name="especialidad">
                                <option value="">Seleccione...</option>
                                @foreach($especialidades as $esp)
                                <option value="{{ $esp->nombre }}" {{ old('especialidad') == $esp->nombre ? 'selected' : '' }}>
                                    {{ $esp->nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('especialidad')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form_group">
                            <label for="fecha_ingreso">Fecha de Ingreso *</label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                                value="{{ old('fecha_ingreso') }}" required>
                            @error('fecha_ingreso')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" rows="4">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form_buttons">
                        <a href="{{ route('administrador.registros.index') }}" class="secondary_button">
                            Cancelar
                        </a>
                        <button type="submit" class="primary_button">
                            Dar de Alta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <x-footer />

    <script>
        function toggleCamposMedico() {
            const tipoEmpleado = document.getElementById('tipo_empleado').value;
            const camposMedico = document.getElementById('campos-medico');
            const nroMatricula = document.getElementById('nro_matricula');
            const especialidad = document.getElementById('especialidad');

            if (tipoEmpleado === 'medico') {
                camposMedico.style.display = 'flex';
                nroMatricula.setAttribute('required', 'required');
                especialidad.setAttribute('required', 'required');
            } else {
                camposMedico.style.display = 'none';
                nroMatricula.removeAttribute('required');
                especialidad.removeAttribute('required');
            }
        }

        // Ejecutar al cargar la página si hay un valor en old
        document.addEventListener('DOMContentLoaded', function() {
            toggleCamposMedico();
        });
    </script>
</body>

</html>