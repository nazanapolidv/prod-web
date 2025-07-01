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
                <form class="flex flex-col" wire:submit.prevent="login">
                    <label for="email">Email</label>
                    <input
                        class="rounded-lg"
                        placeholder="usuario@ejemplo.com"
                        type="email"
                        id="email"
                        wire:model="form.email"
                        required>

                    <label for="password">Contraseña</label>
                    <input
                        class="rounded-lg"
                        placeholder="********"
                        type="password"
                        id="password"
                        wire:model="form.password"
                        required>

                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            wire:model="form.remember">
                        <label for="remember" class="ml-2">Recordarme</label>
                    </div>

                    <button type="submit" class="primary_button">Ingresar</button>
                    <p class="text-center">- o -</p>
                    <a href="{{ route('register') }}" class="secondary_button">Registrarse</a>
                    <p class="recuperar_contrasena text-center">
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="container_image">
            <img src="../assets/sesion.png" alt="">
        </div>
    </main>
</body>

</html>