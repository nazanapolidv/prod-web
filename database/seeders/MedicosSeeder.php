<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;

class MedicosSeeder extends Seeder
{
    public function run()
    {
        Medico::factory()->count(50)->create();
    }
}