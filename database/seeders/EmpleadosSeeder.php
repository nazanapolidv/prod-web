<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        Empleado::factory()->count(20)->create();
    }
}