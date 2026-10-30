<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsVendedor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->rol !== 'Vendedor') {
            abort(403, 'Acceso denegado: esta sección es para el personal vendedor.');
        }

        return $next($request);
    }
}