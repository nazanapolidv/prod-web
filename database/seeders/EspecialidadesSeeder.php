<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadesSeeder extends Seeder
{
    public function run()
    {
        $especialidades = [
            ['nombre' => 'Cardiología'],
            ['nombre' => 'Dermatología'],
            ['nombre' => 'Pediatría'],
            ['nombre' => 'Traumatología'],
            ['nombre' => 'Ginecología'],
            ['nombre' => 'Oftalmología'],
            ['nombre' => 'Neurología'],
            ['nombre' => 'Urología'],
            ['nombre' => 'Gastroenterología'],
            ['nombre' => 'Clínica Médica'],
            ['nombre' => 'Psiquiatría'],
            ['nombre' => 'Nutrición'],
        ];

        foreach ($especialidades as $especialidad) {
            Especialidad::create($especialidad);
        }
    }
}