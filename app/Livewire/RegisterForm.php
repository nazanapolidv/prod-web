<?php

namespace App\Livewire;

use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class RegisterForm extends Component
{
    public string $nombre = '';
    public string $apellido = '';
    public string $tipo_doc = '';
    public string $documento = '';
    public string $genero = '';
    public string $fecha_nac = '';
    public string $telefono = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount()
    {
        logger('Componente RegisterForm montado');
    }

    public function testButton()
    {
        session()->flash('debug', 'Test button funciona! Livewire está funcionando.');
    }

    public function register(): void
    {
        session()->flash('debug', 'Método register ejecutado con datos: ' . json_encode($this->all()));

        logger('Método register llamado', $this->all());

        $validated = $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'tipo_doc' => 'required|string',
            'documento' => 'required|string|max:20|unique:usuarios,documento',
            'genero' => 'required|in:M,F,O',
            'fecha_nac' => 'required|date',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['rol'] = 'paciente';

        $user = Usuario::create($validated);

        event(new Registered($user));
        Auth::login($user);

        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
