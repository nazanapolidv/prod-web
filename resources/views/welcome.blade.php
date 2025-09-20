<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Polaco</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/index.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_main">
            <div class="main_image">
                <img src="{{Vite::asset('resources/assets/banner.png')}}" alt="Hospital Polaco">
            </div>
            <div>
                <h1 class="title">Bienvenido al Hospital Polaco</h1>
                <p class="description_main text-center font-bold">Tu salud es nuestra prioridad. Ofrecemos atención médica de calidad y un equipo de profesionales dedicados a cuidar de vos y tu familia.</p>
            </div>
            <div class="container_button flex justify-center items-center">
                @guest
                <div class="button">
                    <a class="primary_button" href="{{ route('login') }}">Solicitar turno</a>
                </div>
                <div class="button">
                    <a class="secondary_button" href="{{ route('login') }}">Consultar resultados</a>
                </div>
                @else
                <div class="button">
                    <a class="primary_button" href="{{ route('mi-salud') }}">Solicitar turno</a>
                </div>
                <div class="button">
                    <a class="secondary_button" href="{{ route('mi-historial') }}">Consultar resultados</a>
                </div>
                @endguest
            </div>
            <div class="container_especializaciones">
                <h2 class="subtitle">Especializaciones</h2>
                <div class="card_container">
                    <div class="card">
                        <img src="{{Vite::asset('resources/assets/neurologia.png')}}" alt="Neurología">
                        <div class="card-content">
                            <h3 class="text-lg font-semibold text-black-800 text-center">Neurología</h3>
                            <p>Diagnóstico y tratamiento de trastornos del sistema nervioso.</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{Vite::asset('resources/assets/cardiologia.png')}}" alt="Cardiología" class="w-full h-32 object-contain p-4">
                        <div class="card-content">
                            <h3 class="text-lg font-semibold text-black-800 text-center">Cardiología</h3>
                            <p>Prevención, diagnóstico y tratamiento de enfermedades del corazón y vasos sanguíneos.</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{Vite::asset('resources/assets/estetoscopio.png')}}" alt="Clínica general">
                        <div class="card-content">
                            <h3 class="text-lg font-semibold text-black-800 text-center">Clínica general</h3>
                            <p>Atención médica integral para el cuidado y seguimiento de la salud general.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>