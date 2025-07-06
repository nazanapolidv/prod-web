<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi salud</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/mi-historial.css" />

    @vite(['resources/css/mi-historial.css', 'resources/css/app.css'])

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
        <h2 class="title">Historial</h2>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Especialidad</th>
                    <th>Médico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-05-20</td>
                    <td>Cardiología</td>
                    <td>Dr. Juan Pérez</td>
                </tr>
                <tr>
                    <td>2025-05-22</td>
                    <td>Dermatología</td>
                    <td>Dra. Laura Gómez</td>
                </tr>
                <tr>
                    <td>2025-05-25</td>
                    <td>Pediatría</td>
                    <td>Dr. Martín Ruiz</td>
                </tr>
                <tr>
                    <td>2025-05-28</td>
                    <td>Oftalmología</td>
                    <td>Dra. Ana Torres</td>
                </tr>
            </tbody>
        </table>
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