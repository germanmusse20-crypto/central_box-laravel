<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Métricas de Ventas y Finanzas
        $totalVentas = Venta::sum('total') ?? 0;
        $totalSubtotal = Venta::sum('subtotal') ?? 0;
        $totalIva = Venta::sum('iva_monto') ?? 0;
        $conteoVentas = Venta::count();

        // 2. Conteo de entidades
        $totalProductos = Producto::count();
        $totalUsuarios = User::count();
        $totalProveedores = Proveedor::count();

        // 3. Alerta de Stock Crítico (stock <= stock_minimo)
        $productosBajoStock = Producto::with('categoria')
            ->whereColumn('stock', '<=', 'stock_minimo')
            ->take(5)
            ->get();

        // 4. Últimas 5 ventas registradas
        $ultimasVentas = Venta::with('cliente')
            ->orderBy('id_venta', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVentas',
            'totalSubtotal',
            'totalIva',
            'conteoVentas',
            'totalProductos',
            'totalUsuarios',
            'totalProveedores',
            'productosBajoStock',
            'ultimasVentas'
        ));
    }
}