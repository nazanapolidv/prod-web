<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Empleado::query();

        // Filtro por tipo de empleado
        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            if ($request->estado === 'activo') {
                $query->activos();
            } elseif ($request->estado === 'inactivo') {
                $query->inactivos();
            }
        }

        // Búsqueda
        if ($request->filled('busqueda')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->busqueda}%")
                    ->orWhere('apellido', 'like', "%{$request->busqueda}%")
                    ->orWhere('documento', 'like', "%{$request->busqueda}%");
            });
        }

        $empleados = $query->orderBy('created_at', 'desc')->paginate(15);
        $tipos = ['medico', 'administrador'];

        return view('administrador.registros.index', compact('empleados', 'tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especialidades = Especialidad::orderBy('nombre')->get();
        return view('administrador.registros.create', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'documento' => ['required', 'string', 'max:20', 'unique:empleados,documento'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'tipo_empleado' => ['required', 'in:medico,administrador'],
            'fecha_ingreso' => ['required', 'date'],
            'nro_matricula' => ['nullable', 'string', 'max:50', 'required_if:tipo_empleado,medico'],
            'especialidad' => ['nullable', 'string', 'max:100', 'required_if:tipo_empleado,medico'],
            'observaciones' => ['nullable', 'string'],
        ]);

        Empleado::create($validated);

        return redirect()->route('administrador.registros.index')
            ->with('success', 'Empleado dado de alta exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        $especialidades = Especialidad::orderBy('nombre')->get();
        return view('administrador.registros.edit', compact('empleado', 'especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'documento' => ['required', 'string', 'max:20', Rule::unique('empleados')->ignore($empleado->id)],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'tipo_empleado' => ['required', 'in:medico,administrador'],
            'fecha_ingreso' => ['required', 'date'],
            'fecha_egreso' => ['nullable', 'date', 'after_or_equal:fecha_ingreso'],
            'activo' => ['boolean'],
            'nro_matricula' => ['nullable', 'string', 'max:50', 'required_if:tipo_empleado,medico'],
            'especialidad' => ['nullable', 'string', 'max:100', 'required_if:tipo_empleado,medico'],
            'observaciones' => ['nullable', 'string'],
        ]);

        // Manejar checkbox activo (si no viene en request, es false)
        $validated['activo'] = $request->has('activo') && $request->activo == '1';

        // Si se marca como inactivo y no tiene fecha de egreso, usar fecha actual
        if (!$validated['activo'] && empty($validated['fecha_egreso'])) {
            $validated['fecha_egreso'] = now()->toDateString();
        }

        // Si se reactiva, limpiar fecha de egreso
        if ($validated['activo']) {
            $validated['fecha_egreso'] = null;
        }

        $empleado->update($validated);

        return redirect()->route('administrador.registros.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('administrador.registros.index')
            ->with('success', 'Empleado eliminado exitosamente.');
    }
}
