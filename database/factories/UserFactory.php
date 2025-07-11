<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $tiposDocumento = ['dni', 'pasaporte', 'cedula'];
        $generos = ['masculino', 'femenino', 'no-binario'];

        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'tipo_doc' => $this->faker->randomElement($tiposDocumento),
            'documento' => $this->faker->unique()->numerify('########'),
            'genero' => $this->faker->randomElement($generos),
            'fecha_nac' => $this->faker->date('Y-m-d', '-18 years'),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'rol' => 'paciente',
            'remember_token' => Str::random(10),
        ];
    }
}
