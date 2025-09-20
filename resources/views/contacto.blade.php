<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/contacto.css'])
</head>

<body>
    <x-header />
    <main>
        <div class="container_contacto">
            <div class="main_image">
                <img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Hospital Polaco">
            </div>
            <div>
                <h1 class="title">Contacto</h1>
                <p class="description_main">Si tenes alguna consulta o necesitas más información, no dudes en ponerte en contacto con nosotros.</br>Estamos para ayudarte.</p>
            </div>
            
            @if (session('success'))
                <div style="background: #d4edda; color: #155724; padding: 10px; margin: 10px; border: 1px solid #c3e6cb; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;">
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="container_form">
                <form action="{{ route('contacto.store') }}" method="POST">
                    @csrf
                    <label for="name">Nombre</label>
                    <input placeholder="Juan Perez" type="text" id="name" name="name" value="{{ old('name') }}" required>

                    <label for="email">Correo electrónico</label>
                    <input placeholder="ejemplo@gmail.com" type="email" id="email" name="email" value="{{ old('email') }}" required>

                    <label for="message">Mensaje</label>
                    <textarea placeholder="Dejanos tu mensaje" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </main>
    <x-footer />
</body>