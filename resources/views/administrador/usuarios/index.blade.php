<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Usuarios</title>
    @vite(['resources/css/app.css', 'resources/css/abm.css', 'resources/css/usuarios.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <div class="usuarios-header">
                <h1 class="title">Gestión de Usuarios</h1>
                <a href="{{ route('administrador.usuarios.create') }}" class="primary_button">
                    + Crear Nuevo Usuario
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

            <div class="usuarios-container">
                @if($usuarios->count() > 0)
                <div class="table-wrapper">
                    <table class="usuarios-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Documento</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->apellido }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->tipo_doc }}: {{ $usuario->documento }}</td>
                                <td>
                                    <span class="rol-badge rol-{{ $usuario->rol }}">
                                        {{ ucfirst($usuario->rol) }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <a href="{{ route('administrador.usuarios.edit', $usuario) }}"
                                        class="btn-edit" title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('administrador.usuarios.destroy', $usuario) }}"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
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
                    {{ $usuarios->links() }}
                </div>
                @else
                <div class="empty-state">
                    <p>No hay usuarios registrados.</p>
                    <a href="{{ route('administrador.usuarios.create') }}" class="primary_button">
                        Crear Primer Usuario
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