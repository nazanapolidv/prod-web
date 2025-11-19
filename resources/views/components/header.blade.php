<div class="container_header">
    <div class="logo">
        <a href="/"><img src="{{Vite::asset('resources/assets/logo.png')}}" alt="Logo"></a>
    </div>
    <nav class="menu">
        <ul class="menu_list">
            <li><a href="/">Inicio</a></li>
            @if(Auth::check() && Auth::user()->rol === 'administrador')
            <li><a href="{{route('administrador.abm')}}">Panel</a></li>
            @elseif(Auth::check() && Auth::user()->rol === 'paciente')
            <li><a href="{{route('mi-salud')}}">Mi Salud</a></li>
            @elseif(Auth::check() && Auth::user()->rol === 'medico')
            <li><a href="{{route('medico.agenda')}}">Mi Agenda</a></li>
            @endif
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
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        </div>
        @endguest
    </div>
</div>