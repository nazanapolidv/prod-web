<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicoAgendaController extends Controller
{
    /**
     * Mostrar formulario para completar perfil médico
     */
    public function completarPerfil()
    {
        $usuario = Auth::user();
        
        if ($usuario->medico) {
            return redirect()->route('medico.agenda');
        }

        $especialidades = Especialidad::orderBy('nombre')->get();

        return view('medico.completar-perfil', [
            'especialidades' => $especialidades,
        ]);
    }

    /**
     * Guardar perfil médico
     */
    public function guardarPerfil(Request $request)
    {
        $usuario = Auth::user();

        if ($usuario->medico) {
            return redirect()->route('medico.agenda');
        }

        $validated = $request->validate([
            'nro_matricula' => 'required|string|max:50|unique:medicos,nro_matricula',
            'especialidad' => 'required|string|max:100',
            'consultorio' => 'required|string|max:10',
            'horarios_disponibilidad' => 'nullable|array',
        ]);

        // Obtener el apellido del usuario
        $apellido = $usuario->apellido;

        // Crear el registro médico
        Medico::create([
            'usuario_id' => $usuario->id,
            'apellido' => $apellido,
            'nro_matricula' => $validated['nro_matricula'],
            'especialidad' => $validated['especialidad'],
            'consultorio' => $validated['consultorio'],
            'horarios_disponibilidad' => $validated['horarios_disponibilidad'] ?? [],
        ]);

        return redirect()->route('medico.agenda')
            ->with('success', 'Perfil médico completado exitosamente. Ya puedes acceder a tu agenda.');
    }

    /**
     * Mostrar la agenda del médico
     */
    public function index(Request $request)
    {
        $usuario = Auth::user();
        $medico = $usuario->medico;

        if (!$medico) {
            return redirect()->route('medico.completar-perfil')
                ->with('info', 'Por favor, completa tu información profesional para acceder a tu agenda.');
        }

        // Obtener fecha seleccionada (por defecto hoy)
        $fechaSeleccionada = $request->input('fecha', Carbon::today()->toDateString());
        $fechaCarbon = Carbon::parse($fechaSeleccionada);

        // Turnos del día seleccionado
        $turnosDelDia = Turno::where('medico_id', $medico->id)
            ->whereDate('fecha', $fechaSeleccionada)
            ->orderBy('hora')
            ->with(['paciente:id,nombre,apellido,email,telefono', 'especialidad'])
            ->get();

        // Turnos futuros (próximos 7 días)
        $turnosFuturos = Turno::where('medico_id', $medico->id)
            ->whereDate('fecha', '>', $fechaSeleccionada)
            ->whereDate('fecha', '<=', Carbon::parse($fechaSeleccionada)->addDays(7))
            ->orderBy('fecha')
            ->orderBy('hora')
            ->with(['paciente:id,nombre,apellido,email,telefono', 'especialidad'])
            ->get();

        return view('medico.mi-agenda', [
            'turnosDelDia' => $turnosDelDia,
            'turnosFuturos' => $turnosFuturos,
            'fechaSeleccionada' => $fechaSeleccionada,
            'medico' => $medico,
        ]);
    }

    /**
     * Actualizar el estado de un turno
     */
    public function updateEstado(Request $request, Turno $turno)
    {
        $usuario = Auth::user();
        $medico = $usuario->medico;

        // Verificar que el turno pertenece al médico
        if ($turno->medico_id !== $medico->id) {
            return redirect()->route('medico.agenda')
                ->with('error', 'No tienes permisos para modificar este turno.');
        }

        $validated = $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada,finalizada',
        ]);

        $turno->update([
            'estado' => $validated['estado'],
        ]);

        return redirect()->route('medico.agenda', ['fecha' => $turno->fecha->toDateString()])
            ->with('success', 'Estado del turno actualizado correctamente.');
    }

    /**
     * Agregar observaciones a un turno
     */
    public function agregarObservaciones(Request $request, Turno $turno)
    {
        $usuario = Auth::user();
        $medico = $usuario->medico;

        // Verificar que el turno pertenece al médico
        if ($turno->medico_id !== $medico->id) {
            return redirect()->route('medico.agenda')
                ->with('error', 'No tienes permisos para modificar este turno.');
        }

        $validated = $request->validate([
            'observaciones' => 'nullable|string|max:1000',
        ]);

        $turno->update([
            'observaciones' => $validated['observaciones'],
        ]);

        return redirect()->route('medico.agenda', ['fecha' => $turno->fecha->toDateString()])
            ->with('success', 'Observaciones agregadas correctamente.');
    }
}

