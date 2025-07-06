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
    <header>
        <div class="container_header">
            <div class="logo">
                <a href="{{route('home')}}"><img src="../assets/logo-removebg-preview.png" alt="Logo" /></a>
            </div>
            <nav class="menu">
                <ul class="menu_list">
                    <li><a href="{{route('home')}}">Inicio</a></li>
                    <li><a href="misalud.html">Mi Salud</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                </ul>
            </nav>
            <div class="session">
                <a href="inicio-sesion.html"><img src="{{asset('profile.png')}}" alt="iniciar sesion o registrarse"></a>
            </div>
        </div>
    </header>

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

    <footer>
        <div class="container_footer">
            <div class="logo">
                <a href="{{route('home')}}"><img src="../assets/logo-removebg-preview.png" alt="Logo" /></a>
            </div>
            <div class="contact_info">
                <p><b>Hospital Polaco</b></p>
                <p>hola@hospitalpolaco.com</p>
                <p>0800 888 9090</p>
            </div>
            <div class="footer_content">
                <div class="social_media">
                    <a href="#"><img src="{{asset('fb.png')}}" alt="Facebook"></a>
                    <a href="#"><img src="{{asset('x.png')}}" alt="X"></a>
                    <a href="#"><img src="{{asset('instagram.png')}}" alt="Instagram"></a>
                </div>

                <div class="legal">
                    <p>©2025 Todos los derechos reservados</p>
                    <p>Política de privacidad</p>
                    <p>Términos y condiciones</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>