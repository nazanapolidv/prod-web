<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'tipo_doc' => 'DNI',
            'documento' => $this->faker->unique()->numberBetween(20000000, 45000000), 
            'genero' => $this->faker->randomElement(['M', 'F', 'O']),
            'fecha_nac' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'telefono' => $this->faker->numerify('11########'),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'),
            'rol' => 'paciente',
        ];
    }
}
