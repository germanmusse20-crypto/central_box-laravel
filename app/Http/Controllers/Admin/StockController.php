<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\MovimientoInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->orderBy('stock', 'asc')->paginate(12);
        $movimientos = MovimientoInventario::with(['producto', 'usuario'])
            ->orderBy('id', 'desc')
            ->take(15)
            ->get();

        return view('admin.stock.index', compact('productos', 'movimientos'));
    }

    public function ajustar(Request $request, Producto $producto)
    {
        $request->validate([
            'tipo'     => 'required|in:entrada,salida,ajuste',
            'cantidad' => 'required|integer|min:1',
            'motivo'   => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $producto) {
            $stockAnterior = $producto->stock;
            $cantidad = (int) $request->cantidad;

            if ($request->tipo === 'entrada') {
                $stockNuevo = $stockAnterior + $cantidad;
            } elseif ($request->tipo === 'salida') {
                if ($stockAnterior < $cantidad) {
                    throw new \Exception('No hay suficiente stock disponible para realizar esta salida.');
                }
                $stockNuevo = $stockAnterior - $cantidad;
            } else { // ajuste directo
                $stockNuevo = $cantidad;
            }

            // Actualizamos producto
            $producto->update(['stock' => $stockNuevo]);

            // Guardamos movimiento
            MovimientoInventario::create([
                'producto_id'    => $producto->id,
                'usuario_id'     => auth()->id(),
                'tipo'           => $request->tipo,
                'cantidad'       => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_nuevo'    => $stockNuevo,
                'motivo'         => $request->motivo,
            ]);
        });

        return back()->with('success', "Stock actualizado con éxito para {$producto->nombre}.");
    }
}
