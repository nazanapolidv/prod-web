<div>
    <h2>Test Register</h2>
    
    @if (session()->has('success'))
        <div style="color: green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div style="color: red; margin: 10px 0;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red; margin: 10px 0;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="register">
        <div style="margin: 10px 0;">
            <label>Nombre:</label>
            <input type="text" wire:model="nombre" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Apellido:</label>
            <input type="text" wire:model="apellido" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Tipo de documento:</label>
            <select wire:model="tipo_doc" required>
                <option value="">Seleccionar</option>
                <option value="dni">DNI</option>
                <option value="pasaporte">Pasaporte</option>
                <option value="cedula">Cédula</option>
            </select>
        </div>

        <div style="margin: 10px 0;">
            <label>Documento:</label>
            <input type="text" wire:model="documento" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Género:</label>
            <select wire:model="genero" required>
                <option value="">Seleccionar</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="no-binario">No binario</option>
            </select>
        </div>

        <div style="margin: 10px 0;">
            <label>Fecha de nacimiento:</label>
            <input type="date" wire:model="fecha_nac" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Teléfono:</label>
            <input type="text" wire:model="telefono" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Email:</label>
            <input type="email" wire:model="email" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Password:</label>
            <input type="password" wire:model="password" required>
        </div>

        <div style="margin: 10px 0;">
            <label>Confirmar Password:</label>
            <input type="password" wire:model="password_confirmation" required>
        </div>

        <button type="submit" style="margin: 10px 0; padding: 10px 20px;">
            Registrar
        </button>
    </form>
</div>
