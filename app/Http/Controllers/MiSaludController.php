<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MiSaludController extends Controller
{
    /**
     * Display the Mi Salud page.
     */
    public function index(): View
    {
        return view('mi-salud');
    }
}
