<?php

namespace Database\Factories;

use App\Models\Especialidad;
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

        return [
            'apellido' => $this->faker->lastName(),
            'especialidad' => $especialidad ? $especialidad->nombre : 'Clínica Médica',
            'nro_matricula' => 'MP' . $this->faker->unique()->numberBetween(10000, 99999),
            'consultorio' => $this->faker->numberBetween(100, 500),
            'horarios_disponibilidad' => json_encode($horariosDisponibilidad),
        ];
    }
}