<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MiPerfilController extends Controller
{
    public function actualizar(Request $request)
    {
        /** @var \App\Models\User $usuario */
        $usuario = Auth::user();

        $validado = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('usuarios', 'email')->ignore($usuario->id)
            ]
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresá un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.'
        ]);

        try {
            $usuario->email = $validado['email'];

            $usuario->save();
            return redirect()->route('mi-perfil')->with('success', 'Datos actualizados correctamente.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocurrió un error al actualizar los datos. Intentá nuevamente.');
        }
    }
}
