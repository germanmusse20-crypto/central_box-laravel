<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Pago;
use App\Models\MetodoPago;
use App\Models\MovimientoInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // Historial de Ventas
    public function index(Request $request)
    {
        $query = Venta::with(['cliente', 'vendedor'])->orderBy('id_venta', 'desc');

        if (auth()->user()->rol === 'Vendedor') {
    $query->where('id_usuario', auth()->id());
        }

        $ventas = $query->paginate(10);
        return view('admin.ventas.index', compact('ventas'));
    }

    // Formulario de Nueva Venta Online / POS
    public function create()
    {
        $clientes = User::where('rol', 'cliente')->get();
        $productos = Producto::where('activo', true)->where('stock', '>', 0)->get();
        $metodosPago = MetodoPago::where('estado','activo')->get();

        return view('admin.ventas.create', compact('clientes', 'productos', 'metodosPago'));
    }

    // Procesar la Venta
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente'     => 'required|exists:usuarios,id',
            'id_metodo_pago' => 'required|exists:metodos_pago,id',
            'productos'      => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $subtotalGeneral = 0;
            $ivaGeneral = 0;

            // 1. Validar Stock y calcular totales
            $itemsCalculados = [];
            foreach ($request->productos as $item) {
                $producto = Producto::lockForUpdate()->find($item['id']);
                
                if ($producto->stock < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para: {$producto->nombre}. Disponible: {$producto->stock}");
                }

                $subtotalLinea = $producto->precio * $item['cantidad'];
                $ivaMontoLinea = $subtotalLinea * ($producto->iva / 100);
                $totalLinea = $subtotalLinea + $ivaMontoLinea;

                $subtotalGeneral += $subtotalLinea;
                $ivaGeneral += $ivaMontoLinea;

                $itemsCalculados[] = [
                    'producto'      => $producto,
                    'cantidad'      => $item['cantidad'],
                    'precio'        => $producto->precio,
                    'iva_porcentaje'=> $producto->iva,
                    'subtotal'      => $subtotalLinea,
                    'iva_monto'     => $ivaMontoLinea,
                    'total_linea'   => $totalLinea,
                ];
            }

            $totalGeneral = $subtotalGeneral + $ivaGeneral;

            // 2. Crear Pago
            $pago = Pago::create([
                'id_metodo_pago' => $request->id_metodo_pago,
                'monto'          => $totalGeneral,
                'fecha_pago'     => now(),
                'estado'         => 'completado',
                'referencia'     => 'POS-' . strtoupper(uniqid()),
            ]);

            // 3. Crear Venta
            $venta = Venta::create([
                'id_cliente'  => $request->id_cliente,
                'id_usuario'  => auth()->id(),
                'id_pago'     => $pago->id_pago,
                'fecha'       => now(),
                'subtotal'    => $subtotalGeneral,
                'descuento'   => 0,
                'iva'         => 19.00,
                'iva_monto'   => $ivaGeneral,
                'total'       => $totalGeneral,
                'estado'      => 'completada',
                'tipo_venta'  => 'online',
            ]);

            // 4. Guardar Detalles y Descontar Stock
            foreach ($itemsCalculados as $calc) {
                DetalleVenta::create([
                    'id_venta'        => $venta->id_venta,
                    'id_producto'     => $calc['producto']->id,
                    'cantidad'        => $calc['cantidad'],
                    'precio_unitario' => $calc['precio'],
                    'descuento'       => 0,
                    'iva'             => $calc['iva_porcentaje'],
                    'subtotal'        => $calc['subtotal'],
                    'iva_monto'       => $calc['iva_monto'],
                    'total_linea'     => $calc['total_linea'],
                ]);

                // Disminuir Stock
                $stockAnterior = $calc['producto']->stock;
                $stockNuevo = $stockAnterior - $calc['cantidad'];
                $calc['producto']->update(['stock' => $stockNuevo]);

                // Registrar en Kardex
                MovimientoInventario::create([
                    'producto_id'    => $calc['producto']->id,
                    'usuario_id'     => auth()->id(),
                    'tipo'           => 'salida',
                    'cantidad'       => $calc['cantidad'],
                    'stock_anterior' => $stockAnterior,
                    'stock_nuevo'    => $stockNuevo,
                    'motivo'         => "Venta #{$venta->id_venta}",
                ]);
            }

            DB::commit();
            return redirect()
                ->route(
                    auth()->user()->rol === 'Vendedor'
                        ? 'empleado.ventas.show'
                        : 'admin.ventas.show',
                    $venta->id_venta
                )
                ->with('success', '¡Venta registrada con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    // Ver Detalle / Factura de la Venta
    public function show($id)
    {
        $query = Venta::with(['cliente', 'vendedor', 'detalles.producto'])
    ->where('id_venta', $id);

    if (auth()->user()->rol === 'Vendedor') {
        $query->where('id_usuario', auth()->id());
    }

    $venta = $query->firstOrFail();
    }
}