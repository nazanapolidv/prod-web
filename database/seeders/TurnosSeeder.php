<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Turno;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener pacientes (usuarios con rol paciente)
        $pacientes = Usuario::where('rol', 'paciente')->get();
        
        // Si no hay pacientes con rol específico, obtener todos los usuarios
        if ($pacientes->isEmpty()) {
            $pacientes = Usuario::all();
        }

        $medicos = Medico::all();
        $especialidades = Especialidad::all();

        if ($pacientes->isEmpty() || $medicos->isEmpty() || $especialidades->isEmpty()) {
            $this->command->warn('No hay suficientes pacientes, médicos o especialidades para generar turnos.');
            return;
        }

        $estados = ['pendiente', 'completado', 'cancelado'];
        $horas = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
                  '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];

        $observaciones = [
            null,
            'Control de rutina',
            'Seguimiento de tratamiento',
            'Primera consulta',
            'Consulta de urgencia',
            'Control post-operatorio',
            'Revisión de estudios',
            'Consulta por dolor',
        ];

        foreach ($pacientes as $paciente) {
            // Generar entre 2 y 6 turnos por paciente
            $cantidadTurnos = rand(2, 6);

            for ($i = 0; $i < $cantidadTurnos; $i++) {
                $medico = $medicos->random();
                $especialidad = $especialidades->random();
                
                // Generar fecha: 50% pasado, 50% futuro
                if (rand(0, 1) === 0) {
                    // Turno pasado (últimos 90 días)
                    $fecha = Carbon::now()->subDays(rand(1, 90));
                    // Turnos pasados pueden estar completados o cancelados
                    $estado = $estados[array_rand(['completado', 'cancelado'])];
                    $estado = rand(0, 4) < 4 ? 'completado' : 'cancelado'; // 80% completados
                } else {
                    // Turno futuro (próximos 60 días)
                    $fecha = Carbon::now()->addDays(rand(1, 60));
                    // Turnos futuros pueden estar pendientes o cancelados
                    $estado = rand(0, 4) < 4 ? 'pendiente' : 'cancelado'; // 80% pendientes
                }

                $hora = $horas[array_rand($horas)];

                Turno::create([
                    'paciente_id' => $paciente->id,
                    'medico_id' => $medico->id,
                    'especialidad_id' => $especialidad->id,
                    'fecha' => $fecha->format('Y-m-d'),
                    'hora' => $hora,
                    'estado' => $estado,
                    'observaciones' => $observaciones[array_rand($observaciones)],
                ]);
            }
        }

        $this->command->info('Turnos generados exitosamente.');
    }
}