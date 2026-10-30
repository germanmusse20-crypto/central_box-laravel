@extends(auth()->user()->rol === 'Vendedor' ? 'layouts.empleado' : 'layouts.admin')

@section('titulo', 'Historial de Ventas - Central Box')

@section('contenido')
<div class="space-y-6">

    <!-- CABECERA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-receipt text-[#00C897]"></i> Transacciones Comerciales
            </div>
            <h2 class="text-2xl font-black text-gray-900">Historial de Ventas</h2>
            <p class="text-xs text-gray-500 mt-0.5">Auditoría de ventas generadas, estados de orden y comprobantes fiscales</p>
        </div>
        <a href="{{ route(auth()->user()->rol === 'Vendedor' ? 'empleado.ventas.index' : 'admin.ventas.index') }}" class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-4 rounded-xl transition shadow-md shadow-emerald-500/20">
            <i class="fa-solid fa-cart-plus"></i> Nueva Venta
        </a>
    </div>

    <!-- TABLA DE VENTAS -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/70 text-gray-700 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6">Factura</th>
                        <th class="py-4 px-6">Fecha & Hora</th>
                        <th class="py-4 px-6">Cliente</th>
                        <th class="py-4 px-6">Subtotal</th>
                        <th class="py-4 px-6">IVA (19%)</th>
                        <th class="py-4 px-6">Total</th>
                        <th class="py-4 px-6 text-center">Estado</th>
                        <th class="py-4 px-6 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ventas as $vta)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-6 font-black text-gray-900">#{{ $vta->id_venta }}</td>
                            <td class="py-4 px-6 text-xs text-gray-400">{{ $vta->fecha }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $vta->cliente->nombre ?? 'Consumidor Final' }}</td>
                            <td class="py-4 px-6 text-xs text-gray-500">$ {{ number_format($vta->subtotal, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-xs text-gray-500">$ {{ number_format($vta->iva_monto, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 font-black text-emerald-600">$ {{ number_format($vta->total, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 capitalize">
                                    {{ $vta->estado }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route(auth()->user()->rol === 'Vendedor' ? 'empleado.ventas.index' : 'admin.ventas.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 hover:bg-emerald-50 hover:text-emerald-700 text-gray-700 rounded-lg text-xs font-bold transition">
                                    <i class="fa-solid fa-file-invoice"></i> Ver Recibo
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-gray-400">No hay ventas registradas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ventas->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $ventas->links() }}
            </div>
        @endif
    </div>

</div>
@endsection