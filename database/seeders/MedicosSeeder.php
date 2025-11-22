<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class MedicosSeeder extends Seeder
{
    public function run()
    {
        $usuariosMedicos = Usuario::where('rol', 'medico')
            ->whereDoesntHave('medico')
            ->get();

        if ($usuariosMedicos->isEmpty()) {
            $this->command->warn('No hay usuarios médicos disponibles. Ejecuta UsuariosSeeder primero.');
            return;
        }

        $especialidades = Especialidad::all();

        if ($especialidades->isEmpty()) {
            $this->command->warn('No hay especialidades disponibles. Ejecuta EspecialidadesSeeder primero.');
            return;
        }

        foreach ($usuariosMedicos as $usuario) {
            $especialidad = $especialidades->random();

            $horariosDisponibilidad = [
                'lunes' => ['08:00', '17:00'],
                'martes' => ['08:00', '17:00'],
                'miercoles' => ['08:00', '17:00'],
                'jueves' => ['08:00', '17:00'],
                'viernes' => ['08:00', '17:00'],
            ];

            Medico::create([
                'usuario_id' => $usuario->id,
                'apellido' => $usuario->apellido,
                'especialidad' => $especialidad->nombre,
                'nro_matricula' => 'MP' . fake()->unique()->numberBetween(10000, 99999),
                'consultorio' => fake()->numberBetween(100, 500),
                'horarios_disponibilidad' => $horariosDisponibilidad,
            ]);
        }

        $this->command->info('Se crearon ' . $usuariosMedicos->count() . ' médicos asociados a usuarios existentes.');
    }
}
