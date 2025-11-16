<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABM</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/abm.css" />

    @vite(['resources/css/abm.css', 'resources/css/app.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <h1 class="title">Dashboard</h1>

            <div class="container_especializaciones">
                <div class="card_container">
                    <a href="{{ route('administrador.usuarios.index') }}" class="card-link">
                        <div class="card">
                            <div class="card-content">
                                <img src="{{Vite::asset('resources/assets/gestiondeusuario.png')}}" alt="Gestion de Usuarios">
                                <h3>Gestión de usuarios</h3>
                                <p>Administra las cuentas de pacientes o médicos</p>
                            </div>
                        </div>
                    </a>
                    <div class="card">
                        <div class="card-content">
                            <img src="{{Vite::asset('resources/assets/registros.png')}}" alt="Registros">
                            <h3>Registros</h3>
                            <p>Control de registros y egresos de empleados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer />
</body>

</html>