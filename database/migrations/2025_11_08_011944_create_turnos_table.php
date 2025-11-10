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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')->constrained('usuarios');
            $table->foreignId('medico_id')->constrained('medicos');
            $table->foreignId('especialidad_id')->constrained('especialidades');

            $table->date('fecha');
            $table->time('hora');
            
            $table->string('estado')->default('pendiente');

            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
