<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 👈 Importante

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('login');
        }

        // Obtén el rol del usuario autenticado
        $userRole = Auth::user()->rol;

        // Verifica si el rol está permitido
        if (!in_array($userRole, $roles)) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}