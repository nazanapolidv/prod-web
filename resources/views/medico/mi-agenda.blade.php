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

            <!-- selector -->
            <div style="margin-bottom: 20px;">
                <form method="GET" action="{{ route('medico.agenda') }}" style="display: flex; align-items: center; gap: 10px;">
                    <label for="fecha">Ver fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="{{ $fechaSeleccionada }}" 
                           style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Buscar
                    </button>
                </form>
            </div>

            <!-- turnos de hoy -->
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
                            <form method="POST" action="{{ route('medico.turnos.update-estado', $turno->id) }}">
                                @csrf
                                @method('PUT')
                                <div style="display: flex; gap: 5px;">
                                    <select name="estado" style="padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                                        <option value="pendiente" {{ $turno->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="confirmada" {{ $turno->estado === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                        <option value="cancelada" {{ $turno->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                        <option value="finalizada" {{ $turno->estado === 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                                    </select>
                                    <button type="submit" style="padding: 5px 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                        ✓
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('medico.turnos.observaciones', $turno->id) }}">
                                @csrf
                                @method('PUT')
                                <div style="display: flex; flex-direction: column; gap: 5px;">
                                    <textarea name="observaciones" rows="2" 
                                              style="width: 200px; padding: 5px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;"
                                              placeholder="Observaciones...">{{ $turno->observaciones }}</textarea>
                                    <button type="submit" style="padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                        Guardar
                                    </button>
                                </div>
                            </form>
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

            <!-- turnos proximos (7 dias) -->
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

    <x-footer />
</body>

</html>