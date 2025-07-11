<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi salud</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/mi-salud.css'])

</head>

<body>
    <header>
        <div class="container_header">
            <div class="logo">
                <a href="{{route('home')}}"><img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Logo" /></a>
            </div>
            <nav class="menu">
                <ul class="menu_list">
                    <li><a href="{{route('home')}}">Inicio</a></li>
                    <li><a href="{{route('mi-salud')}}">Mi Salud</a></li>
                    <li><a href="{{route('contacto')}}">Contacto</a></li>
                </ul>
            </nav>
            <div class="session">
                @auth
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{route('login')}}">
                        <img src="{{ Vite::asset('resources/assets/profile.png') }}" alt="iniciar sesion o registrarse" />
                    </a>
                @endauth
            </div>
        </div>
    </header>
    <main>
        <h2 class="title">Mi Salud</h2>
        <h3 class="subtitle">¡Hola, <b>{{ Auth::user()->nombre ?? 'Usuario' }}</b>!</h3>
        <div class="container_mi_salud">
            <div class="card_container">
                <div class="card">
                    <div class="card_image_container">
                        <img src="{{ Vite::asset('resources/assets/calendar.png') }}" alt="Citas" />
                    </div>
                    <div class="card-content">
                        <h3>Mis citas</h3>
                        <p>Desde acá podes gestionar tus citas médicas</p>
                    </div>
                </div>
                <div class="card">
                    <a href="{{route('mi-historial')}}">
                    <div class="card_image_container">
                        <img src="{{ Vite::asset('resources/assets/calendar.png') }}" alt="Historial" />
                    </div>
                    <div class="card-content">
                        <h3>Mi historial</h3>
                        <p>
                            Consultá tu historial de atención en nuestros centros médicos
                        </p>
                    </div>
                    </a>
                </div>
                <div class="card">
                    <div class="card_image_container">
                        <img src="{{ Vite::asset('resources/assets/profile.png') }}" alt="Perfil" />
                    </div>
                    <div class="card-content">
                        <h3>Mi perfil</h3>
                        <p>Actualizá tu perfil</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container_footer">
            <div class="logo">
                <a href="{{route('home')}}"><img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Logo" /></a>
            </div>
            <div class="contact_info">
                <p><b>Hospital Polaco</b></p>
                <p>hola@hospitalpolaco.com</p>
                <p>0800 888 9090</p>
            </div>
            <div class="footer_content">
                <div class="social_media">
                    <a href="#"><img src="{{ Vite::asset('resources/assets/fb.png') }}" alt="Facebook" /></a>
                    <a href="#"><img src="{{ Vite::asset('resources/assets/x.png') }}"src="{{ Vite::asset('resources/assets/fb.png') }}" alt="X" /></a>
                    <a href="#"><img src="{{ Vite::asset('resources/assets/instagram.png') }}" alt="Instagram" /></a>
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