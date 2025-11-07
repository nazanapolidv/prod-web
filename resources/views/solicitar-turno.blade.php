<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solicitar Turno - Hospital Polaco</title>
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
            <form method="POST" action="{{ route('turnos.store') }}">
                @csrf

                <div class="form_group">
                    <label for="especialidad_id">Especialidad:</label>
                    <select name="especialidad_id" id="especialidad_id" required>
                        <option value="">Selecciona una especialidad</option>
                        @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}" {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                            {{ $especialidad->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('especialidad_id')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="medico_id">Médico:</label>
                    <select name="medico_id" id="medico_id" required disabled>
                        <option value="">Primero selecciona una especialidad</option>
                    </select>
                    @error('medico_id')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" required disabled
                        min="{{ date('Y-m-d') }}"
                        max="{{ date('Y-m-d', strtotime('+3 months')) }}"
                        value="{{ old('fecha') }}">
                    @error('fecha')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="hora">Hora:</label>
                    <select name="hora" id="hora" required disabled>
                        <option value="">Primero selecciona fecha</option>
                    </select>
                    @error('hora')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="observaciones">Motivo de consulta (opcional):</label>
                    <textarea name="observaciones" id="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                    @error('observaciones')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form_buttons">
                    <a href="{{ route('mis-citas') }}" class="secondary_button">Cancelar</a>
                    <button type="submit" class="primary_button">Confirmar Turno</button>
                </div>
            </form>
        </div>
    </main>
    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const especialidadSelect = document.getElementById('especialidad_id');
            const medicoSelect = document.getElementById('medico_id');
            const fechaInput = document.getElementById('fecha');
            const horaSelect = document.getElementById('hora');

            especialidadSelect.addEventListener('change', function() {
                medicoSelect.innerHTML = '<option value="">Cargando médicos...</option>';
                medicoSelect.disabled = true;
                fechaInput.disabled = true;
                horaSelect.disabled = true;
                horaSelect.innerHTML = '<option value="">Primero selecciona fecha</option>';

                if (!this.value) {
                    medicoSelect.innerHTML = '<option value="">Primero selecciona una especialidad</option>';
                    return;
                }
                const especialidadNombre = especialidadSelect.options[especialidadSelect.selectedIndex].text;

                fetch(`/turnos/medicos/${encodeURIComponent(especialidadNombre)}`)
                    .then(response => response.json())
                    .then(medicos => {
                        medicoSelect.innerHTML = '<option value="">Selecciona un médico</option>';

                        if (medicos.length === 0) {
                            medicoSelect.innerHTML = '<option value="">No hay médicos disponibles</option>';
                            return;
                        }

                        medicos.forEach(medico => {
                            const option = document.createElement('option');
                            option.value = medico.id;
                            option.textContent = `${medico.apellido}, ${medico.nombre}`;
                            medicoSelect.appendChild(option);
                        });

                        medicoSelect.disabled = false;

                        const oldMedicoId = '{{ old('
                        medico_id ') }}';
                        if (oldMedicoId) {
                            medicoSelect.value = oldMedicoId;
                            medicoSelect.dispatchEvent(new Event('change'));
                        }
                    });
            });

            medicoSelect.addEventListener('change', function() {
                fechaInput.disabled = !this.value;
                horaSelect.disabled = true;
                horaSelect.innerHTML = '<option value="">Primero selecciona fecha</option>';

                if (fechaInput.value && this.value) {
                    fechaInput.dispatchEvent(new Event('change'));
                }
            });

            fechaInput.addEventListener('change', function() {
                if (!this.value || !medicoSelect.value) {
                    horaSelect.innerHTML = '<option value="">Primero selecciona fecha</option>';
                    horaSelect.disabled = true;
                    return;
                }

                horaSelect.innerHTML = '<option value="">Cargando horarios...</option>';
                horaSelect.disabled = true;

                fetch(`/turnos/horarios?medico_id=${medicoSelect.value}&fecha=${this.value}`)
                    .then(response => response.json())
                    .then(horarios => {
                        horaSelect.innerHTML = horarios.length ?
                            '<option value="">Selecciona un horario</option>' :
                            '<option value="">No hay horarios disponibles</option>';

                        horarios.forEach(hora => {
                            const option = document.createElement('option');
                            option.value = hora;
                            option.textContent = hora + ' hs';
                            horaSelect.appendChild(option);
                        });

                        horaSelect.disabled = !horarios.length;

                        const oldHora = '{{ old('
                        hora ') }}';
                        if (oldHora) {
                            horaSelect.value = oldHora;
                        }
                    });
            });

            if (especialidadSelect.value) {
                especialidadSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>

</html>