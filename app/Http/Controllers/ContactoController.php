<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactoController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index(): View
    {
        return view('contacto');
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        Contacto::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'mensaje' => $request->message,
        ]);

        return redirect()->route('contacto')->with('success', '¡Gracias por tu mensaje! Te responderemos pronto.');
    }
}
