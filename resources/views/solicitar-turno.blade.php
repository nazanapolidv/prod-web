<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solicitar Turno</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/solicitar-turno.css'])
</head>

<body>
    <x-header />
    <main>
        <h2 class="title">Solicitar Turno</h2>

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="container_form">
            <form method="GET" action="{{ route('turnos.create') }}" id="filtro-form">
                
                <div class="form_group">
                    <label for="especialidad_id">1. Seleccione una especialidad:</label>
                    <select name="especialidad_id" id="especialidad_id" onchange="document.getElementById('filtro-form').submit()">
                        <option value="">Selecciona una especialidad</option>
                        @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}" {{ $selectedEspecialidadId == $especialidad->id ? 'selected' : '' }}>
                            {{ $especialidad->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                @if($selectedEspecialidadId)
                    <div class="form_group">
                        <label for="medico_id">2. Seleccione un médico:</label>
                        <select name="medico_id" id="medico_id" onchange="document.getElementById('filtro-form').submit()">
                            <option value="">Selecciona un médico</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}" {{ $selectedMedicoId == $medico->id ? 'selected' : '' }}>
                                    {{ $medico->nombre }} {{ $medico->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if($selectedMedicoId)
                    <div class="form_group">
                        <label for="fecha">3. Seleccione una fecha:</label>
                        <input type="date" name="fecha" id="fecha"
                            min="{{ date('Y-m-d') }}"
                            max="{{ date('Y-m-d', strtotime('+3 months')) }}"
                            value="{{ $selectedFecha }}"
                            onchange="document.getElementById('filtro-form').submit()">
                    </div>
                @endif
            </form>

            @if($selectedEspecialidadId && $selectedMedicoId && $selectedFecha)
                <hr>
                <form method="POST" action="{{ route('turnos.store') }}">
                    @csrf
                    <input type="hidden" name="especialidad_id" value="{{ $selectedEspecialidadId }}">
                    <input type="hidden" name="medico_id" value="{{ $selectedMedicoId }}">
                    <input type="hidden" name="fecha" value="{{ $selectedFecha }}">

                    <div class="form_group">
                        <label for="hora">4. Seleccione una hora:</label>
                        <select name="hora" id="hora" required>
                            <option value="">Selecciona una hora</option>
                            @forelse($horariosDisponibles as $hora)
                                <option value="{{ $hora }}">{{ $hora }}</option>
                            @empty
                                <option value="" disabled>No hay horarios disponibles para esta fecha</option>
                            @endforelse
                        </select>
                        @error('hora')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form_group">
                        <label for="observaciones">Motivo de consulta (opcional):</label>
                        <textarea name="observaciones" id="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                    </div>

                    <div class="form_buttons">
                        <a href="{{ route('mis-citas') }}" class="secondary_button">Cancelar</a>
                        <button type="submit" class="primary_button" @if(empty($horariosDisponibles)) disabled @endif>Confirmar Turno</button>
                    </div>
                </form>
            @endif
        </div>
    </main>
    <x-footer />
</body>

</html>