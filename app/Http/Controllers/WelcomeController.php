<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Muestra la página de bienvenida para usuarios autenticados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        // Actualizar la fecha del último inicio de sesión
        $user->last_login_at = now();
        $user->save();
        
        return view('welcome-user', compact('user'));
    }
}
