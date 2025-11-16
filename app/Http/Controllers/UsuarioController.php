<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->paginate(15);
        return view('administrador.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'tipo_doc' => ['required', 'in:dni,pasaporte,cedula'],
            'documento' => ['required', 'string', 'max:20', 'unique:usuarios,documento'],
            'genero' => ['required', 'in:masculino,femenino,no-binario'],
            'fecha_nac' => ['required', 'date', 'before:today'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100', 'unique:usuarios,email'],
            'password' => ['required', 'string', 'min:8'],
            'rol' => ['required', 'in:paciente,administrador,medico'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Usuario::create($validated);

        return redirect()->route('administrador.usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('administrador.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'tipo_doc' => ['required', 'in:dni,pasaporte,cedula'],
            'documento' => ['required', 'string', 'max:20', Rule::unique('usuarios')->ignore($usuario->id)],
            'genero' => ['required', 'in:masculino,femenino,no-binario'],
            'fecha_nac' => ['required', 'date', 'before:today'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => ['nullable', 'string', 'min:8'],
        ];

        // Solo validar rol si no es el mismo usuario autenticado
        if (auth()->id() !== $usuario->id) {
            $rules['rol'] = ['required', 'in:paciente,administrador,medico'];
        }

        $validated = $request->validate($rules);

        // Prevenir que un administrador cambie su propio rol
        if (auth()->id() === $usuario->id) {
            unset($validated['rol']);
        }

        // Solo actualizar password si se proporciona
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('administrador.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        // Prevenir que un administrador se elimine a sí mismo
        if (auth()->id() === $usuario->id) {
            return redirect()->route('administrador.usuarios.index')
                ->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()->route('administrador.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
