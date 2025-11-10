<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mis Citas</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/mis-citas.css" />
    @vite(['resources/css/mis-citas.css', 'resources/css/app.css'])
</head>

<body>
    <x-header />

    <main>
        <h2 class="title">Próximos Turnos</h2>

        @php
        /** @var \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Collection $turnos */
        $turnos = $turnos ?? collect();
        $paginated = $paginated ?? ($turnos instanceof \Illuminate\Pagination\AbstractPaginator);
        \Carbon\Carbon::setLocale(app()->getLocale() ?: 'es');
        @endphp

        <div class="container_mis_citas">
            <div class="card_container">
                @forelse($turnos as $t)
                @php
                // Convertimos la fecha a una cadena 'Y-m-d' antes de unirla con la hora
                $fechaYHora = $t->fecha->toDateString() . ' ' . $t->hora;
                $dt = \Carbon\Carbon::parse($fechaYHora);

                // Formateamos para que muestre fecha y hora
                $fechaHumana = $dt->translatedFormat('d \d\e F \d\e Y \a \l\a\s H:i \h\s');
                $medico = trim(($t->medico->nombre ?? '').' '.($t->medico->apellido ?? '')) ?: '—';
                @endphp

                <x-card.without-image
                    :especialidad="$t->especialidad->nombre ?? '—'"
                    :dr="$medico"
                    :fecha="$fechaHumana" />
                @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="empty-state-title">No hay turnos próximos</h3>
                    <p class="empty-state-message">No tenes turnos a futuro con nosotros.</p>
                </div>
                @endforelse
            </div>

            @if($paginated)
            <div class="pagination">
                {{ $turnos->links() }}
            </div>
            @endif

            <div class="container_button">
                <div class="button">
                    <a class="primary_button" href="{{ route('turnos.create') }}">Solicitar turno</a>
                </div>
            </div>
        </div>
    </main>

    <x-footer />
</body>

</html>