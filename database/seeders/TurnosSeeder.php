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
        $pacientes = Usuario::where('rol', 'paciente')->get();
        
        $medicos = Medico::all();
        $especialidades = Especialidad::all();

        if ($pacientes->isEmpty() || $medicos->isEmpty() || $especialidades->isEmpty()) {
            $this->command->warn('No hay suficientes pacientes, médicos o especialidades para generar turnos.');
            return;
        }

        $medicoHardcodeado = Usuario::where('email', 'medico@hospital.com')->first();
        if ($medicoHardcodeado) {
            $medicoRecord = Medico::where('usuario_id', $medicoHardcodeado->id)->first();
            $primerPaciente = $pacientes->first();
            $primeraEspecialidad = $especialidades->first();

            if ($medicoRecord && $primerPaciente && $primeraEspecialidad) {
                // Turno para hoy
                Turno::create([
                    'paciente_id' => $primerPaciente->id,
                    'medico_id' => $medicoRecord->id,
                    'especialidad_id' => $primeraEspecialidad->id,
                    'fecha' => Carbon::today()->format('Y-m-d'),
                    'hora' => '10:00',
                    'estado' => 'pendiente',
                    'observaciones' => 'Turno de prueba para el médico hardcodeado',
                ]);

                // Turno para mañana
                Turno::create([
                    'paciente_id' => $primerPaciente->id,
                    'medico_id' => $medicoRecord->id,
                    'especialidad_id' => $primeraEspecialidad->id,
                    'fecha' => Carbon::tomorrow()->format('Y-m-d'),
                    'hora' => '14:30',
                    'estado' => 'pendiente',
                    'observaciones' => 'Seguimiento de control',
                ]);

                $this->command->info('Turnos hardcodeados creados para medico@hospital.com');
            }
        }

        $estados = ['pendiente', 'completado', 'cancelado'];
        $horas = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
                  '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];

        $observaciones = [
            'Control de rutina',
            'Seguimiento de tratamiento',
            'Primera consulta',
            'Consulta de urgencia',
            'Control post-operatorio',
            'Revisión de estudios',
            'Consulta por dolor',
        ];

        foreach ($pacientes as $paciente) {
            $cantidadTurnos = 6;

            for ($i = 0; $i < $cantidadTurnos; $i++) {
                $medico = $medicos->random();
                $especialidad = $especialidades->random();
                
                // generacion random de fechas pasadas y futuras, % de estados de esos turnos
                if (rand(0, 1) === 0) {
                    $fecha = Carbon::now()->subDays(rand(1, 90));
                    $estado = $estados[array_rand(['completado', 'cancelado'])];
                    $estado = rand(0, 4) < 4 ? 'completado' : 'cancelado';
                } else {
                    $fecha = Carbon::now()->addDays(rand(1, 60));
                    $estado = rand(0, 4) < 4 ? 'pendiente' : 'cancelado';
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