<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registros de Empleados</title>
    @vite(['resources/css/app.css', 'resources/css/abm.css', 'resources/css/registros.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <div class="registros-header">
                <h1 class="title">Registros de Empleados</h1>
                <a href="{{ route('administrador.registros.create') }}" class="primary_button">
                    + Dar de Alta Empleado
                </a>
            </div>

            @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
            @endif

            <!-- Filtros -->
            <div class="filtros-container">
                <form method="GET" action="{{ route('administrador.registros.index') }}" class="filtros-form">
                    <div class="filtros-row">
                        <div class="filtro-group">
                            <label for="tipo">Tipo:</label>
                            <select name="tipo" id="tipo">
                                <option value="">Todos</option>
                                @foreach($tipos as $tipo)
                                <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>
                                    {{ ucfirst($tipo) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filtro-group">
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado">
                                <option value="">Todos</option>
                                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="filtro-group">
                            <label for="busqueda">Búsqueda:</label>
                            <input type="text" name="busqueda" id="busqueda"
                                value="{{ request('busqueda') }}"
                                placeholder="Nombre, apellido o documento">
                        </div>

                        <div class="filtro-group">
                            <button type="submit" class="primary_button">Filtrar</button>
                            <a href="{{ route('administrador.registros.index') }}" class="secondary_button">Limpiar</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="registros-container">
                @if($empleados->count() > 0)
                <div class="table-wrapper">
                    <table class="registros-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Documento</th>
                                <th>Tipo</th>
                                <th>Fecha Ingreso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->id }}</td>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->apellido }}</td>
                                <td>{{ $empleado->documento }}</td>
                                <td>
                                    <span class="tipo-badge tipo-{{ $empleado->tipo_empleado }}">
                                        {{ ucfirst($empleado->tipo_empleado) }}
                                    </span>
                                </td>
                                <td>{{ $empleado->fecha_ingreso->format('d/m/Y') }}</td>
                                <td>
                                    <span class="estado-badge estado-{{ $empleado->activo ? 'activo' : 'inactivo' }}">
                                        {{ $empleado->estado_laboral }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <a href="{{ route('administrador.registros.edit', $empleado->id) }}"
                                        class="btn-edit" title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('administrador.registros.destroy', $empleado->id) }}"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{ $empleados->links() }}
                </div>
                @else
                <div class="empty-state">
                    <p>No hay empleados registrados.</p>
                    <a href="{{ route('administrador.registros.create') }}" class="primary_button">
                        Dar de Alta Primer Empleado
                    </a>
                </div>
                @endif
            </div>

            <div class="back-link">
                <a href="{{ route('administrador.abm') }}" class="secondary_button">
                    ← Volver al Panel
                </a>
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>