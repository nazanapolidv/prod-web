<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi Agenda - Médico</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/mi-agenda.css" />

    @vite(['resources/css/mi-agenda.css', 'resources/css/app.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="miagenda-container">
            <h2 class="title">Mi Agenda</h2>

            @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error" style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
            @endif

            <!-- Selector de fecha -->
            <div style="margin-bottom: 20px;">
                <form method="GET" action="{{ route('medico.agenda') }}" style="display: inline-block;">
                    <label for="fecha" style="margin-right: 10px;">Ver fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="{{ $fechaSeleccionada }}" 
                           onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </form>
            </div>

            <!-- Citas del día seleccionado -->
            <h3 class="heading">Citas del {{ \Carbon\Carbon::parse($fechaSeleccionada)->translatedFormat('d \d\e F \d\e Y') }}</h3>
            
            @if($turnosDelDia->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turnosDelDia as $turno)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($turno->hora)->format('H:i') }}</td>
                        <td>
                            {{ $turno->paciente->nombre ?? 'N/A' }} {{ $turno->paciente->apellido ?? '' }}
                            @if($turno->paciente)
                            <br><small style="color: #666;">{{ $turno->paciente->email ?? '' }}</small>
                            @endif
                        </td>
                        <td>{{ $turno->especialidad->nombre ?? 'N/A' }}</td>
                        <td>
                            <form method="POST" action="{{ route('medico.turnos.update-estado', $turno->id) }}" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <select name="estado" onchange="this.form.submit()" 
                                        style="padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                                    <option value="pendiente" {{ $turno->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="confirmada" {{ $turno->estado === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                    <option value="cancelada" {{ $turno->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    <option value="finalizada" {{ $turno->estado === 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            @if($turno->observaciones)
                            <small>{{ Str::limit($turno->observaciones, 50) }}</small>
                            @else
                            <small style="color: #999;">Sin observaciones</small>
                            @endif
                        </td>
                        <td>
                            <button onclick="mostrarObservaciones({{ $turno->id }}, '{{ addslashes($turno->observaciones ?? '') }}')" 
                                    style="padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                Observaciones
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div style="padding: 20px; text-align: center; color: #666;">
                <p>No hay turnos programados para esta fecha.</p>
            </div>
            @endif

            <!-- Próximos turnos (próximos 7 días) -->
            @if($turnosFuturos->count() > 0)
            <h3 class="heading" style="margin-top: 40px;">Próximos Turnos (Próximos 7 días)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turnosFuturos as $turno)
                    <tr>
                        <td>{{ $turno->fecha->translatedFormat('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($turno->hora)->format('H:i') }}</td>
                        <td>{{ $turno->paciente->nombre ?? 'N/A' }} {{ $turno->paciente->apellido ?? '' }}</td>
                        <td>{{ $turno->especialidad->nombre ?? 'N/A' }}</td>
                        <td>
                            <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; 
                                @if($turno->estado === 'confirmada') background: #d4edda; color: #155724;
                                @elseif($turno->estado === 'cancelada') background: #f8d7da; color: #721c24;
                                @elseif($turno->estado === 'finalizada') background: #d1ecf1; color: #0c5460;
                                @else background: #fff3cd; color: #856404;
                                @endif">
                                {{ ucfirst($turno->estado) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </main>

    <!-- Modal para observaciones -->
    <div id="modalObservaciones" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border-radius: 8px; max-width: 500px; width: 90%;">
            <h3 style="margin-top: 0;">Agregar/Editar Observaciones</h3>
            <form method="POST" id="formObservaciones">
                @csrf
                @method('PUT')
                <textarea name="observaciones" id="textareaObservaciones" rows="5" 
                          style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 15px;"
                          placeholder="Ingrese observaciones sobre este turno..."></textarea>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModal()" 
                            style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Cancelar
                    </button>
                    <button type="submit" 
                            style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />

    <script>
        function mostrarObservaciones(turnoId, observacionesActuales) {
            document.getElementById('textareaObservaciones').value = observacionesActuales;
            document.getElementById('formObservaciones').action = '/mi-agenda/turnos/' + turnoId + '/observaciones';
            document.getElementById('modalObservaciones').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modalObservaciones').style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modalObservaciones').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });
    </script>
</body>

</html>

