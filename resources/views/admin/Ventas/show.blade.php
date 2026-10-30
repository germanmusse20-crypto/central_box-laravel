@extends(auth()->user()->rol === 'Vendedor' ? 'layouts.empleado' : 'layouts.admin')

@section('titulo', 'Factura #' . $venta->id_venta . ' - Central Box')

@section('contenido')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- BOTONES DE ACCIÓN -->
    <div class="flex items-center justify-between no-print">
        <a href="{{ route(auth()->user()->rol === 'Vendedor' ? 'empleado.ventas.index' : 'admin.ventas.index') }}" class="text-xs font-bold text-gray-600 hover:text-gray-900 flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> Volver al historial
        </a>
        <button onclick="window.print()" class="bg-gray-900 hover:bg-black text-white text-xs font-bold py-2.5 px-5 rounded-xl transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-print"></i> Imprimir Factura
        </a>
    </div>

    <!-- DOCUMENTO FACTURA / COMPROBANTE -->
    <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-lg text-gray-800 printable-area">
        <!-- Encabezado de la Factura -->
        <div class="flex justify-between items-start pb-8 border-b border-gray-200">
            <div>
                <h1 class="text-2xl font-black text-gray-900 leading-tight">Central <span class="text-[#00C897]">Box</span></h1>
                <p class="text-xs text-gray-500 mt-1">Tu tienda virtual de confianza</p>
                <p class="text-xs text-gray-500">NIT: 900.123.456-7 • Colombia</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 uppercase mb-1">
                    {{ $venta->estado }}
                </span>
                <h3 class="text-xl font-black text-gray-900">FACTURA #{{ $venta->id_venta }}</h3>
                <p class="text-xs text-gray-400">Fecha: {{ $venta->fecha }}</p>
            </div>
        </div>

        <!-- Datos del Cliente y Vendedor -->
        <div class="grid grid-cols-2 gap-6 py-6 border-b border-gray-100 text-xs">
            <div>
                <p class="font-bold text-gray-400 uppercase tracking-wider mb-1">Cliente:</p>
                <p class="font-bold text-sm text-gray-900">{{ $venta->cliente->nombre ?? 'Consumidor Final' }}</p>
                <p class="text-gray-500">{{ $venta->cliente->email ?? '' }}</p>
                <p class="text-gray-500">Tel: {{ $venta->cliente->telefono ?? 'N/A' }}</p>
            </div>
            <div class="text-right">
                <p class="font-bold text-gray-400 uppercase tracking-wider mb-1">Atendido Por:</p>
                <p class="font-bold text-sm text-gray-900">{{ $venta->vendedor->nombre ?? 'Sistema' }}</p>
                <p class="text-gray-500">Canal: <strong class="capitalize">{{ $venta->tipo_venta }}</strong></p>
            </div>
        </div>

        <!-- Tabla de Artículos Facturados -->
        <table class="w-full text-left text-xs my-6">
            <thead class="border-b-2 border-gray-200 text-gray-400 uppercase tracking-wider">
                <tr>
                    <th class="py-3">Descripción</th>
                    <th class="py-3 text-center">Cant.</th>
                    <th class="py-3 text-right">Precio Unit.</th>
                    <th class="py-3 text-right">IVA</th>
                    <th class="py-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($venta->detalles as $det)
                    <tr>
                        <td class="py-3.5 font-bold text-gray-800">{{ $det->producto->nombre ?? 'Producto' }}</td>
                        <td class="py-3.5 text-center font-bold">{{ $det->cantidad }}</td>
                        <td class="py-3.5 text-right">$ {{ number_format($det->precio_unitario, 0, ',', '.') }}</td>
                        <td class="py-3.5 text-right">{{ $det->iva }}%</td>
                        <td class="py-3.5 text-right font-black text-gray-900">$ {{ number_format($det->total_linea, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Liquidación Final -->
        <div class="pt-4 border-t-2 border-gray-200 flex justify-end">
            <div class="w-64 space-y-2 text-xs">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal:</span>
                    <strong class="text-gray-900">$ {{ number_format($venta->subtotal, 0, ',', '.') }}</strong>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>IVA Total (19%):</span>
                    <strong class="text-gray-900">$ {{ number_format($venta->iva_monto, 0, ',', '.') }}</strong>
                </div>
                <div class="flex justify-between text-base font-black text-gray-900 pt-2 border-t border-gray-200">
                    <span>TOTAL FACTURADO:</span>
                    <span class="text-[#00C897]">$ {{ number_format($venta->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="text-center text-[10px] text-gray-400 mt-12 pt-6 border-t border-gray-100">
            ¡Gracias por comprar en Central Box! • Documento oficial de venta.
        </div>
    </div>

</div>

<style>
    @media print {
        body * { visibility: hidden; }
        .printable-area, .printable-area * { visibility: visible; }
        .printable-area { position: absolute; left: 0; top: 0; width: 100%; border: none; box-shadow: none; }
        .no-print { display: none !important; }
    }
</style>
@endsection