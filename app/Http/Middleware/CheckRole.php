<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Si el usuario no está autenticado, redirigir al login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Si no se especificaron roles, permitir el acceso
        if (empty($roles)) {
            return $next($request);
        }

        // Verificar si el usuario tiene alguno de los roles requeridos
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // Si el usuario no tiene ningún rol requerido, redirigir a la página de bienvenida
        return redirect()->route('welcome')->with('status', '¡Bienvenido! Has iniciado sesión correctamente.');
    }
}
