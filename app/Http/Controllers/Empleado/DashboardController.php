<?php

namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\Producto;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Obtenemos el mes actual
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        // 2. Métrica 1: Ventas del mes (Suma total)
        // Intentamos filtrar por la columna 'fecha', si no hay usamos el total general
        try {
            $ventasMes = Venta::whereMonth('fecha', $mesActual)
                              ->whereYear('fecha', $anioActual)
                              ->sum('total');
            $pedidosConfirmados = Venta::whereMonth('fecha', $mesActual)
                                       ->whereYear('fecha', $anioActual)
                                       ->count();
        } catch (\Exception $e) {
            $ventasMes = Venta::sum('total') ?? 0;
            $pedidosConfirmados = Venta::count();
        }

        // 3. Métrica 3: Productos sin stock (stock <= 0)
        $productosSinStock = Producto::where('stock', '<=', 0)->count();

        // 4. Saludo dinámico según la hora del día
        $hora = Carbon::now('America/Bogota')->hour;
        if ($hora >= 5 && $hora < 12) {
            $saludo = 'Buenos días';
        } elseif ($hora >= 12 && $hora < 18) {
            $saludo = 'Buenas tardes';
        } else {
            $saludo = 'Buenas noches';
        }

        return view('Empleado.dashboard', compact(
            'ventasMes',
            'pedidosConfirmados',
            'productosSinStock',
            'saludo'
        ));
    }
}