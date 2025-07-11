<?php

namespace App\Livewire;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class TestRegister extends Component
{
    public $nombre = '';
    public $apellido = '';
    public $tipo_doc = '';
    public $documento = '';
    public $genero = '';
    public $fecha_nac = '';
    public $telefono = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function register()
    {
        try {
            $validated = $this->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'tipo_doc' => 'required|string',
                'documento' => 'required|string|max:20|unique:usuarios,documento',
                'genero' => 'required|string',
                'fecha_nac' => 'required|date',
                'telefono' => 'required|string|max:20',
                'email' => 'required|email|max:255|unique:usuarios,email',
                'password' => 'required|confirmed|min:8',
            ]);

            $validated['password'] = Hash::make($validated['password']);
            $validated['rol'] = 'paciente';

            $user = Usuario::create($validated);

            session()->flash('success', 'Usuario creado exitosamente!');
            $this->reset();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.test-register');
    }
}
