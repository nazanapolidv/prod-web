<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi salud</title>
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
                <a href="inicio-sesion.html"><img
                        src="../assets/profile.png"
                        alt="iniciar sesion o registrarse" /></a>
            </div>
        </div>
    </header>
    <main>
        <h2 class="title">Próximos Turnos</h2>

        <div class="container_mis_citas">
            <div class="card_container">
                <div class="card">
                    <div class="card-content">
                        <h3>10 de Junio de 2025</h3>
                        <p>Neurología</p>
                        <p>Dr. Leandro Gomez</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>20 de Agosto de 2025</h3>
                        <p>Dermatología</p>
                        <p>Dra. María Herrera</p>
                    </div>
                </div>
            </div>
            <div class="container_button">
                <div class="button">
                    <a class="primary_button" href="/html/misalud.html">Solicitar turno</a>
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
                    <a href="#"><img src="../assets/fb.png" alt="Facebook" /></a>
                    <a href="#"><img src="../assets/x.png" alt="X" /></a>
                    <a href="#"><img src="../assets/instagram.png" alt="Instagram" /></a>
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