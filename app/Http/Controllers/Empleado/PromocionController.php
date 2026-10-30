<?php

namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use App\Models\Promocion;
use Illuminate\View\View;

class PromocionController extends Controller
{
    public function index(): View
    {
        $hoy = now()->toDateString();

        $promociones = Promocion::with(['producto.categoria'])
            ->where('estado', 'aprobada')
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->whereHas('producto', function ($consulta) {
                $consulta->where('activo', true);
            })
            ->orderBy('fecha_fin')
            ->get();

        return view('Empleado.promociones', compact('promociones'));
    }
}