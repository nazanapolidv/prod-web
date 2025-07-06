<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/contacto.css'])
</head>

<body>
    <header>
        <div class="container_header">
            <div class="logo">
                <a href="{{route('home')}}"><img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Logo"></a>
            </div>
            <nav class="menu">
                <ul class="menu_list">
                    <li><a href="{{route('home')}}">Inicio</a></li>
                    <li><a href="{{route('mi-salud')}}">Mi Salud</a></li>
                    <li><a href="{{route('contacto')}}">Contacto</a></li>
                </ul>
            </nav>
            <div class="session">
                <a href="inicio-sesion.html"><img src="{{ Vite::asset('resources/assets/profile.png') }}" alt="iniciar sesion o registrarse"></a>
            </div>
        </div>
    </header>
    <main>
        <div class="container_contacto">
            <div class="main_image">
                <img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Hospital Polaco">
            </div>
            <div>
                <h1 class="title">Contacto</h1>
                <p class="description_main">Si tenes alguna consulta o necesitas más información, no dudes en ponerte en contacto con nosotros.</br>Estamos para ayudarte.</p>
            </div>
            <div class="container_form">
                <form action="#" method="post">
                    <label for="name">Nombre</label>
                    <input placeholder="Juan Perez" type="text" id="name" name="name" required>

                    <label for="email">Correo electrónico</label>
                    <input placeholder="ejemplo@gmail.com" type="email" id="email" name="email" required>

                    <label for="message">Mensaje</label>
                    <textarea placeholder="Dejanos tu mensaje" id="message" name="message" rows="4" required></textarea>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="container_footer">
            <div class="logo">
                <a href="{{route('home')}}"><img src="../assets/logo-removebg-preview.png" alt="Logo"></a>
            </div>
            <div class="contact_info">
                <p><b>Hospital Polaco</b></p>
                <p>hola@hospitalpolaco.com</p>
                <p>0800 888 9090</p>
            </div>
            <div class="footer_content">
                <div class="social_media">
                    <a href="#"><img src="{{ Vite::asset('resources/assets/fb.png') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ Vite::asset('resources/assets/x.png') }}" alt="X"></a>
                    <a href="#"><img src="{{ Vite::asset('resources/assets/instagram.png') }}" alt="Instagram"></a>
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