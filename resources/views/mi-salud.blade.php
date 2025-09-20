<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi salud</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/mi-salud.css'])

</head>

<body>
    <x-header />
    <main>
        <h2 class="title">Mi Salud</h2>
        <h3 class="subtitle">¡Hola, <b>{{ Auth::user()->nombre ?? 'Usuario' }}</b>!</h3>
        <div class="container_mi_salud">
            <div class="card_container">
                <x-card.left-image
                    title="Mis citas"
                    text="Desde acá podés gestionar tus citas médicas"
                    img="resources/assets/calendar.png"
                    alt="Citas"
                    link="/mis-citas"
                />
                <x-card.left-image
                    title="Mi historial"
                    text="Consultá tu historial de atención en nuestros centros médicos"
                    img="resources/assets/historial.png"
                    alt="Historial"
                    link="/mi-historial"
                />
                <x-card.left-image
                    title="Mi perfil"
                    text="Actualizá tu perfil"
                    img="resources/assets/profile.png"
                    alt="Perfil"
                    link="/mi-perfil"
                />
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>