<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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
        
        // Obtener categorías activas ordenadas por nombre
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        return view('welcome', compact('user', 'categories'));
    }
}
