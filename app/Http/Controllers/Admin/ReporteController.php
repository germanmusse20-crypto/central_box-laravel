<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->toDateString());
        $fechaFin    = $request->input('fecha_fin', now()->endOfMonth()->toDateString());

        // Consultas filtradas por fecha
        $ventasPeriodo = Venta::whereBetween(DB::raw('DATE(fecha)'), [$fechaInicio, $fechaFin]);

        $totalIngresos = (clone $ventasPeriodo)->sum('total') ?? 0;
        $totalSubtotal = (clone $ventasPeriodo)->sum('subtotal') ?? 0;
        $totalIvaRecaudado = (clone $ventasPeriodo)->sum('iva_monto') ?? 0;
        $cantidadVentas = (clone $ventasPeriodo)->count();

        // Productos más vendidos en el periodo
        $topProductos = DetalleVenta::select('id_producto', DB::raw('SUM(cantidad) as total_vendido'), DB::raw('SUM(total_linea) as dinero_generado'))
            ->whereHas('venta', function ($q) use ($fechaInicio, $fechaFin) {
                $q->whereBetween(DB::raw('DATE(fecha)'), [$fechaInicio, $fechaFin]);
            })
            ->with('producto')
            ->groupBy('id_producto')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        return view('admin.reportes.index', compact(
            'fechaInicio',
            'fechaFin',
            'totalIngresos',
            'totalSubtotal',
            'totalIvaRecaudado',
            'cantidadVentas',
            'topProductos'
        ));
    }
}