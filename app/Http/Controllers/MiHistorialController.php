<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MiHistorialController extends Controller
{
    public function index()
    {
        $paciente = Paciente::where('usuario_id', Auth::id())->first();

        if (!$paciente) {
            return view('mi-historial', [
                'turnos' => collect(),
                'paginated' => false
            ]);
        }

        $hoy   = Carbon::today()->toDateString();
        $ahora = Carbon::now()->format('H:i:s');

        $turnos = Turno::with([
                'especialidad:id,nombre',
                'medico:id,nombre,apellido'
            ])
            ->where('paciente_id', $paciente->id)
            ->where(function ($q) use ($hoy, $ahora) {
                $q->where('fecha', '<', $hoy)
                  ->orWhere(function ($q2) use ($hoy, $ahora) {
                      $q2->where('fecha', '=', $hoy)
                         ->where('hora', '<=', $ahora);
                  });
            })
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->paginate(10);

        return view('mi-historial', [
            'turnos' => $turnos,
            'paginated' => true
        ]);
    }
}

