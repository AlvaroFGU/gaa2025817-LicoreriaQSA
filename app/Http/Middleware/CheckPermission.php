<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $usuario = Auth::user();

        if (!$usuario) {
            // Redirigir a la página de login si el usuario no está autenticado
            return redirect()->route('login');
        }

        $rol = $usuario->empleado->rol;

        if (($rol && in_array($permission, explode(',', $rol->Permisos)))||$permission==0) {
            return $next($request);
        }

        // Redirigir a una página de acceso denegado si el usuario no tiene permiso
        return redirect()->route('access.denied');
    }
}
