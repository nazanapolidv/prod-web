<?php
namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MiHistorialController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id();

        if (!$usuarioId) {
            return view('mi-historial', [
                'turnos' => collect(),
                'paginated' => false
            ]);
        }

        $hoy   = Carbon::today()->toDateString();
        $ahora = Carbon::now()->format('H:i:s');

        $turnos = Turno::with([
                'especialidad:id,nombre',
                'medico:id,apellido'
            ])
            ->where('paciente_id', $usuarioId)
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