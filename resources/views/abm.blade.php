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
                    <div class="card">
                        <img src="{{asset('gestiondeusuario.png')}}"
                            alt="Gestión de usuarios" />
                        <div class="card-content">
                            <h3>Gestión de usuarios</h3>
                            <p>Administra las cuentas de pacientes o médicos</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{asset('estadisticas.png')}}" alt="estadisticas" />
                        <div class="card-content">
                            <h3>Estadísticas</h3>
                            <p>Visor de estadísticas de pacientes o médicos</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{asset('registros.png')}}" alt="Registros" />
                        <div class="card-content">
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