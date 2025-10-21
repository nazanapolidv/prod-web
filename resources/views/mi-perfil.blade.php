<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi Perfil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/mi-perfil.css'])
</head>

<body>
    <x-header />
    <main>
        <h2 class="title">Mi Perfil</h2>
        <img src="{{ Vite::asset('resources/assets/user.png') }}" class="user_img" alt="foto de perfil">
        <div class="datos">
            <div class="columna">
                <p><strong>Nombre</strong>{{ Auth::user()->nombre ?? 'Usuario' }}</p>
                <p><strong>Correo electrónico</strong>{{ Auth::user()->email ?? '—' }}</p>
            </div>
            <div class="columna">
                <p><strong>Apellido</strong>{{ Auth::user()->apellido ?? '—' }}</p>
                <p><strong>Fecha de nacimiento</strong>{{ Auth::user()->fecha_nacimiento ? \Carbon\Carbon::parse(Auth::user()->fecha_nacimiento)->translatedFormat('d \d\e F \d\e Y') : '—' }}</p>
            </div>
        </div>
        <button class="primary_button edit_btn">Actualizar datos</button>
    </main>
    <x-footer />
</body>

</html>