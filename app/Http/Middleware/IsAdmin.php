<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role > 0) {
            $uri = $request->path();
            // Solo las rutas de socios (excepto "socios-todos") requieren club seleccionado
            $isSociosTodos = str_starts_with($uri, 'admin/socios-todos');
            $requiresClub = str_starts_with($uri, 'admin/socios') && !$isSociosTodos;

            if ($requiresClub) {
                if (session()->has('clubSeleccionado') === true) {
                    return $next($request);
                }
                return redirect()->route('home');
            }

            // Para el resto de secciones, no exigimos club seleccionado
            return $next($request);
        }
        return redirect()->route('inicio'); // If user is not an admin.
    }
}
