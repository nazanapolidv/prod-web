<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Completar Perfil Médico</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .horarios-section {
            margin-top: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 4px;
        }
        .horario-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        .horario-item input {
            flex: 1;
        }
        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-add {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-submit {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background: #0056b3;
        }
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
    </style>
</head>

<body>
    <x-header />
    <main>
        <div class="container">
            <h1>Completar Perfil Médico</h1>

            @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert" style="background-color: #f8d7da; color: #721c24;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('medico.guardar-perfil') }}" id="formPerfil">
                @csrf

                <div class="form-group">
                    <label for="nro_matricula">Número de Matrícula *</label>
                    <input type="text" id="nro_matricula" name="nro_matricula" 
                           value="{{ old('nro_matricula') }}" required>
                    @error('nro_matricula')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="especialidad">Especialidad *</label>
                    <select id="especialidad" name="especialidad" required>
                        <option value="">Seleccione una especialidad...</option>
                        @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->nombre }}" 
                                {{ old('especialidad') == $especialidad->nombre ? 'selected' : '' }}>
                            {{ $especialidad->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('especialidad')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="consultorio">Consultorio *</label>
                    <input type="text" id="consultorio" name="consultorio" 
                           value="{{ old('consultorio') }}" required maxlength="10">
                    @error('consultorio')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="horarios-section">
                    <label>Horarios de Disponibilidad (Opcional)</label>
                    <p style="font-size: 14px; color: #666; margin-bottom: 15px;">
                        Puedes agregar tus horarios de disponibilidad. Ejemplo: "Lunes a Viernes 8:00-17:00"
                    </p>
                    <div id="horarios-container">
                        <div class="horario-item">
                            <input type="text" name="horarios_disponibilidad[]" 
                                   placeholder="Ej: Lunes a Viernes 8:00-17:00">
                            <button type="button" class="btn-remove" onclick="removeHorario(this)" style="display: none;">Eliminar</button>
                        </div>
                    </div>
                    <button type="button" class="btn-add" onclick="addHorario()">+ Agregar Horario</button>
                </div>

                <button type="submit" class="btn-submit">Guardar Perfil</button>
            </form>
        </div>
    </main>

    <x-footer />

    <script>
        function addHorario() {
            const container = document.getElementById('horarios-container');
            const newItem = document.createElement('div');
            newItem.className = 'horario-item';
            newItem.innerHTML = `
                <input type="text" name="horarios_disponibilidad[]" 
                       placeholder="Ej: Lunes a Viernes 8:00-17:00">
                <button type="button" class="btn-remove" onclick="removeHorario(this)">Eliminar</button>
            `;
            container.appendChild(newItem);
            updateRemoveButtons();
        }

        function removeHorario(button) {
            button.parentElement.remove();
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const items = document.querySelectorAll('.horario-item');
            items.forEach((item, index) => {
                const removeBtn = item.querySelector('.btn-remove');
                if (items.length > 1) {
                    removeBtn.style.display = 'block';
                } else {
                    removeBtn.style.display = 'none';
                }
            });
        }

        // Inicializar botones al cargar
        document.addEventListener('DOMContentLoaded', updateRemoveButtons);
    </script>
</body>

</html>

