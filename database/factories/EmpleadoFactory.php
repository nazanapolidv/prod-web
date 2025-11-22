<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    public function definition(): array
    {
        $tipo = $this->faker->randomElement(['administrador', 'medico']);

        return [
            'nombre'         => $this->faker->firstName(),
            'apellido'       => $this->faker->lastName(),
            'documento'      => $this->faker->unique()->numerify('########'),
            'telefono'       => $this->faker->phoneNumber(),
            'email'          => $this->faker->unique()->safeEmail(),
            // 'tipo_empleado'  => $tipo,
            'fecha_ingreso'  => $this->faker->dateTimeBetween('-10 years', 'now'),
            'fecha_egreso'   => $this->faker->boolean(20) ? $this->faker->dateTimeBetween('-5 years', 'now') : null,
            'activo'         => $this->faker->boolean(80),
            'nro_matricula'  => $tipo === 'medico' ? $this->faker->numerify('MAT####') : null,
            'especialidad'   => $tipo === 'medico' ? $this->faker->randomElement(['Clínica Médica', 'Pediatría', 'Traumatología', 'Cardiología']) : null,
            'observaciones'  => $this->faker->optional()->sentence(),
        ];
    }
}