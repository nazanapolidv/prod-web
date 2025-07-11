<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->enum('tipo_doc', ['dni', 'pasaporte', 'cedula']);
            $table->string('documento', 20)->unique();
            $table->enum('genero', ['masculino', 'femenino', 'no-binario']);
            $table->date('fecha_nac');
            $table->string('telefono', 20);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->enum('rol', ['paciente', 'medico', 'administrador']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
