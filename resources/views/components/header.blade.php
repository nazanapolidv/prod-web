<div class="container_header">
    <div class="logo">
        <a href="/"><img src="{{Vite::asset('resources/assets/logo.png')}}" alt="Logo"></a>
    </div>
    <nav class="menu">
        <ul class="menu_list">
            <li><a href="/">Inicio</a></li>
            <li><a href="{{route('mi-salud')}}">Mi Salud</a></li>
            <li><a href="{{route('contacto')}}">Contacto</a></li>
        </ul>
    </nav>
    <div class="session">
        @guest
        <a href="{{ route('login') }}">
            <img src="{{ Vite::asset('resources/assets/profile.png') }}" alt="Iniciar sesión o registrarse">
        </a>
        @else
        <div class="dropdown">
            <button class="user-button">
                {{ Auth::user()->name }}
            </button>

            <div class="dropdown-menu">
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
                @elseif(Auth::user()->role === 'paciente')
                <a href="{{ route('paciente.turnos') }}">Mis Turnos</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        </div>
        @endguest
    </div>
</div>