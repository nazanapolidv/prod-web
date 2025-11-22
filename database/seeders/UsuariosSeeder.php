<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'tipo_doc' => 'DNI',
            'documento' => '12345678',
            'genero' => 'O',
            'fecha_nac' => '1990-01-01',
            'telefono' => '1234567890',
            'email' => 'admin@hospital.com',
            'password' => Hash::make('admin123'),
            'rol' => 'administrador',
        ]);

        $pacientes = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'documento' => '30123456',
                'genero' => 'M',
                'fecha_nac' => '1995-05-15',
                'telefono' => '1122334455',
                'email' => 'juan.perez@example.com',
            ],
            [
                'nombre' => 'María',
                'apellido' => 'González',
                'documento' => '31234567',
                'genero' => 'F',
                'fecha_nac' => '1992-08-20',
                'telefono' => '1133445566',
                'email' => 'maria.gonzalez@example.com',
            ],
        ];

        foreach ($pacientes as $paciente) {
            Usuario::create([
                'nombre' => $paciente['nombre'],
                'apellido' => $paciente['apellido'],
                'tipo_doc' => 'DNI',
                'documento' => $paciente['documento'],
                'genero' => $paciente['genero'],
                'fecha_nac' => $paciente['fecha_nac'],
                'telefono' => $paciente['telefono'],
                'email' => $paciente['email'],
                'password' => Hash::make('password123'),
                'rol' => 'paciente',
            ]);
        }

        Usuario::factory()->count(20)->create([
            'rol' => 'paciente',
        ]);

        Usuario::factory()->count(15)->create([
            'rol' => 'medico',
        ]);
    }
}
