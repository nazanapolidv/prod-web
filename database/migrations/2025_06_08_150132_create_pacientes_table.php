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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->unique();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->enum('tipo_documento', ['DNI', 'LC', 'LE', 'Pasaporte', 'Otro']);
            $table->string('nro_documento', 30)->unique();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->date('fecha_nacimiento');
            $table->string('telefono_linea', 20)->nullable();
            $table->string('celular', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
