<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnoController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $turnos = Turno::where('paciente_id', $usuario->id)
            ->where('fecha', '>=', Carbon::today())
            ->orderBy('fecha')
            ->orderBy('hora')
            ->with(['medico', 'especialidad'])
            ->get();

        return view('mis-citas', compact('turnos'));
    }
    public function create(Request $request)
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();

        $selectedEspecialidadId = $request->input('especialidad_id');
        $selectedMedicoId = $request->input('medico_id');
        $selectedFecha = $request->input('fecha');

        $medicos = collect();
        $horariosDisponibles = [];

        if ($selectedEspecialidadId) {
            $especialidad = Especialidad::find($selectedEspecialidadId);
            if ($especialidad) {
                $medicos = Medico::where('especialidad', $especialidad->nombre)
                    ->orderBy('apellido')
                    ->get();
            }
        }

        if ($selectedMedicoId && $selectedFecha) {
            $horariosDisponibles = $this->getAvailableSlotsForDate($selectedMedicoId, $selectedFecha);
        }

        return view('solicitar-turno', [
            'especialidades' => $especialidades,
            'medicos' => $medicos,
            'horariosDisponibles' => $horariosDisponibles,
            'selectedEspecialidadId' => $selectedEspecialidadId,
            'selectedMedicoId' => $selectedMedicoId,
            'selectedFecha' => $selectedFecha,
        ]);
    }

    private function getAvailableSlotsForDate($medico_id, $fecha)
    {
        $horariosBase = [];

        $inicio = Carbon::parse($fecha)->startOfDay()->setHour(8);
        $fin = Carbon::parse($fecha)->startOfDay()->setHour(17);

        while ($inicio < $fin) {
            $horariosBase[] = $inicio->format('H:i');
            $inicio->addMinutes(30);
        }

        $turnosOcupados = Turno::where('medico_id', $medico_id)
            ->where('fecha', $fecha)
            ->pluck('hora')
            ->map(fn($hora) => Carbon::parse($hora)->format('H:i'))
            ->toArray();

        return array_values(array_diff($horariosBase, $turnosOcupados));
    }

    public function getMedicos($especialidad_nombre)
    {
        $medicos = Medico::where('especialidad', $especialidad_nombre)
            ->orderBy('apellido')
            ->get()
            ->map(function ($medico) {
                $usuario = $medico->usuario;
                return [
                    'id' => $medico->id,
                    'nombre' => $usuario ? $usuario->nombre : '',
                    'apellido' => $medico->apellido
                ];
            });

        return response()->json($medicos);
    }

    public function getHorarios(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
        ]);

        $medico_id = $request->medico_id;
        $fecha = $request->fecha;
        $medico = Medico::find($medico_id);

        if (!$medico || empty($medico->horarios_disponibilidad)) {
            $horarios = [];
            $start = 8 * 60;
            $end = 17 * 60;
            $step = 30;

            for ($i = $start; $i < $end; $i += $step) {
                $horarios[] = sprintf('%02d:%02d', floor($i / 60), $i % 60);
            }
        } else {
            $horarios = [];
            $start = 8 * 60;
            $end = 17 * 60;
            $step = 30;

            for ($i = $start; $i < $end; $i += $step) {
                $horarios[] = sprintf('%02d:%02d', floor($i / 60), $i % 60);
            }
        }

        $turnosOcupados = Turno::where('medico_id', $medico_id)
            ->where('fecha', $fecha)
            ->pluck('hora')
            ->map(function ($hora) {
                return Carbon::parse($hora)->format('H:i');
            })
            ->toArray();

        $horariosDisponibles = array_filter($horarios, function ($hora) use ($turnosOcupados) {
            return !in_array($hora, $turnosOcupados);
        });

        return response()->json(array_values($horariosDisponibles));
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'especialidad_id' => 'required|exists:especialidades,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'observaciones' => 'nullable|string|max:500',
        ]);

        $horaFormateada = Carbon::parse($request->hora)->format('H:i:s');

        $existeTurno = Turno::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $horaFormateada)
            ->exists();

        if ($existeTurno) {
            return back()->withInput()->withErrors([
                'hora' => 'El horario seleccionado ya no está disponible. Por favor, elige otro.'
            ]);
        }

        Turno::create([
            'paciente_id' => Auth::id(),
            'medico_id' => $request->medico_id,
            'especialidad_id' => $request->especialidad_id,
            'fecha' => $request->fecha,
            'hora' => $horaFormateada,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('mis-citas')
            ->with('success', 'Turno solicitado correctamente. Te informaremos cuando sea confirmado.');
    }

    public function destroy($id)
    {
        $turno = Turno::findOrFail($id);

        if ($turno->paciente_id != Auth::id()) {
            abort(403, 'No autorizado');
        }

        $turno->delete();

        return redirect()->route('mis-citas')
            ->with('success', 'Turno cancelado correctamente.');
    }
}
