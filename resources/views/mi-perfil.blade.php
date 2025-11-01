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

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
        @endif

        <img src="{{ Vite::asset('resources/assets/user.png') }}" class="user_img" alt="foto de perfil">

        <div class="datos">
            <div class="columna">
                <p><strong>Nombre:</strong> {{ Auth::user()->nombre ?? 'Usuario' }}</p>
                <p><strong>Correo electrónico:</strong> {{ Auth::user()->email ?? '—' }}</p>
            </div>
            <div class="columna">
                <p><strong>Apellido:</strong> {{ Auth::user()->apellido ?? '—' }}</p>
            </div>
        </div>

        <button class="primary_button edit_btn" id="btnEditarPerfil">Actualizar datos</button>

        <div id="modalEditarPerfil" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Actualizar datos personales</h3>

                <form method="POST" action="{{ route('perfil.actualizar') }}">
                    @csrf
                    @method('PUT')

                    <div class="form_group">
                        <label for="email">Correo electrónico:</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', Auth::user()->email) }}"
                            required>
                        @error('email')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form_buttons">
                        <button type="button" class="secondary_button btn-cancelar">Cancelar</button>
                        <button type="submit" class="primary_button">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalEditarPerfil');
            const btnEditar = document.getElementById('btnEditarPerfil');
            const btnCerrar = document.querySelector('.close');
            const btnCancelar = document.querySelector('.btn-cancelar');

            btnEditar.addEventListener('click', function() {
                modal.style.display = 'flex';
            });

            btnCerrar.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            btnCancelar.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>