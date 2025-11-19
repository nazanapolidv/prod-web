<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modificar el ENUM de rol para incluir 'medico'
        // En MySQL, modificar un ENUM requiere usar SQL directo
        DB::statement("ALTER TABLE usuarios MODIFY COLUMN rol ENUM('paciente', 'administrador', 'medico')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al ENUM original sin 'medico'
        DB::statement("ALTER TABLE usuarios MODIFY COLUMN rol ENUM('paciente', 'administrador')");
    }
};
