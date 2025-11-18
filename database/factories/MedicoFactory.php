<?php

namespace Database\Factories;

use App\Models\Especialidad;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoFactory extends Factory
{
    public function definition(): array
    {
        $especialidad = Especialidad::inRandomOrder()->first();

        $horariosDisponibilidad = [
            'lunes' => ['08:00', '17:00'],
            'martes' => ['08:00', '17:00'],
            'miercoles' => ['08:00', '17:00'],
            'jueves' => ['08:00', '17:00'],
            'viernes' => ['08:00', '17:00'],
        ];

        // Buscar un usuario médico existente sin médico asignado, o crear uno si no existe
        $usuario = Usuario::where('rol', 'medico')
            ->whereDoesntHave('medico')
            ->inRandomOrder()
            ->first();

        if (!$usuario) {
            // Si no hay usuarios médicos disponibles, crear uno
            $usuario = Usuario::factory()->create([
                'rol' => 'medico',
            ]);
        }

        return [
            'usuario_id' => $usuario->id,
            'apellido' => $usuario->apellido,
            'especialidad' => $especialidad ? $especialidad->nombre : 'Clínica Médica',
            'nro_matricula' => 'MP' . $this->faker->unique()->numberBetween(10000, 99999),
            'consultorio' => $this->faker->numberBetween(100, 500),
            'horarios_disponibilidad' => $horariosDisponibilidad,
        ];
    }
}
