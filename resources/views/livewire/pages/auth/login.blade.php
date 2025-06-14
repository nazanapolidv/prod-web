<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/assets/css/inicio-sesion.css')
</head>

<body>
    <main>
        <!-- Session Status -->
        <div class="container_inicio_sesion">
            <div class="main_image">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{asset('logo-removebg-preview.png')}}" alt="Hospital Polaco">
                </a>
            </div>
            <div>
                <h1 class="title">Iniciar sesion</h1>
            </div>
            <div class="container_form">
                <form class="flex flex-col" action="#" method="get" wire:submit.prevent="login">
                    <label for="name">Usuario</label>
                    <input class="rounded-lg" placeholder="jperez0001" type="text" id="name" name="name" required>

                    <label for="password">Contraseña</label>
                    <input class="rounded-lg" placeholder="********" type="password" id="password" name="password" required>

                    <button type="submit" class="primary_button">Ingresar</button>
                    <p class="text-center">- o -</p>
                    <a href="registro.html" class="secondary_button">Registrarse</a>
                    <p class="recuperar_contrasena text-center">¿Olvidaste tu contraseña?</p>
                </form>
            </div>
        </div>
        <div class="container_image">
            <img src="../assets/sesion.png" alt="">
        </div>
    </main>
</body>

</html>