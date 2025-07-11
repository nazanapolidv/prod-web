@extends('layouts.guest')

@section('content')
<div>
    @if (session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border: 1px solid #f5c6cb; border-radius: 4px;">
            {{ session('error') }}
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

    <div class="container_registro">
        <div class="main_image">
            <a href="{{route('home')}}" class="logo flex justify-center items-center w-auto">
                <img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="Hospital Polaco" />
            </a>
        </div>
        
        <div class="form_group">
            <h1 class="title">Iniciar Sesión</h1>
        </div>
        
        <div class="container_form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@gmail.com" required />
                </div>

                <div class="form_group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required />
                </div>

                <div class="form_group">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember">
                        Recordarme
                    </label>
                </div>

                <button type="submit" class="primary_button">Iniciar Sesión</button>
            </form>
            
            <div class="form_group">
                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
