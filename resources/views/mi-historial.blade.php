<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi Historial</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/mi-historial.css" />

    @vite(['resources/css/mi-historial.css', 'resources/css/app.css'])

</head>

<body>
    <x-header />
     <h2 class="title">Historial</h2>

  @if(($paginated ? $turnos->count() : $turnos->isNotEmpty()))
    <table>
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Especialidad</th>
          <th>Médico</th>
        </tr>
      </thead>
      <tbody>
        @foreach($turnos as $t)
          <tr>
            <td>{{ optional($t->fecha)->format('Y-m-d') ?? (string)$t->fecha }}</td>
            <td>{{ $t->hora }}</td>
            <td>{{ $t->especialidad->nombre ?? '—' }}</td>
            <td>
              @php
                $medicoNombre = trim(($t->medico->nombre ?? '').' '.($t->medico->apellido ?? ''));
              @endphp
              {{ $medicoNombre !== '' ? $medicoNombre : '—' }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    @if($paginated)
      <div class="mt-4">
        {{ $turnos->links() }}
      </div>
    @endif
@else
    <div class="empty-state">
        <div class="empty-state-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <h3 class="empty-state-title">No hay turnos en tu historial</h3>
        <p class="empty-state-message">No encontramos citas médicas registradas en tu historial.</p>
    </div>
  @endif
    <x-footer />
</body>

</html>