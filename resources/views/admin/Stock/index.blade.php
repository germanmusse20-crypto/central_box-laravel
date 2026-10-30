@extends(auth()->user()->rol === 'Vendedor' ? 'layouts.empleado' : 'layouts.admin')

@section('titulo', 'Kardex y Gestión de Stock - Central Box')

@section('contenido')
<div class="space-y-8">

    <!-- CABECERA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-boxes-stacked text-[#00C897]"></i> Control de Existencias
            </div>
            <<h2 class="text-2xl font-black text-gray-900">
                {{ auth()->user()->rol === 'Vendedor' ? 'Consulta de inventario' : 'Gestión de Stock & Kardex' }}
            </h2>

            <p class="text-xs text-gray-500 mt-0.5">
                {{ auth()->user()->rol === 'Vendedor'
                    ? 'Consulta las existencias y los movimientos recientes de productos.'
                    : 'Realiza ajustes directos de inventario con trazabilidad.' }}
            </p>
        </div>
    </div>

    <!-- CUADRÍCULA DE AJUSTE RÁPIDO DE STOCK POR PRODUCTO -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Ajustar Stock de Productos</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($productos as $prod)
                <div class="p-5 rounded-2xl border {{ $prod->stock <= $prod->stock_minimo ? 'border-red-200 bg-red-50/20' : 'border-gray-100 bg-gray-50/50' }} flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-400 uppercase">{{ $prod->categoria->nombre ?? 'General' }}</span>
                            <span class="px-2.5 py-0.5 text-xs font-extrabold rounded-full {{ $prod->stock <= $prod->stock_minimo ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $prod->stock }} en stock
                            </span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm leading-tight">{{ $prod->nombre }}</h4>
                        <p class="text-[11px] text-gray-500 mt-1">Mínimo sugerido: {{ $prod->stock_minimo }} unidades</p>
                    </div>
                    @if (auth()->user()->rol === 'Admin')
                    <!-- FORMULARIO DE AJUSTE RÁPIDO -->
                    <form action="{{ route('admin.stock.ajustar', $prod->id) }}" method="POST" class="mt-4 pt-3 border-t border-gray-200/60 space-y-3">
                        @csrf
                        @else
                            <p class="mt-4 border-t border-gray-200/60 pt-3 text-xs text-gray-400">
                                Consulta de inventario: no puedes modificar las existencias.
                            </p>
                        @endif
                        <div class="grid grid-cols-2 gap-2">
                            <select name="tipo" required class="rounded-xl border-gray-200 text-xs py-1.5 focus:border-[#00C897] focus:ring-[#00C897]">
                                <option value="entrada">+ Entrada</option>
                                <option value="salida">- Salida</option>
                                <option value="ajuste">Ajuste Fijo</option>
                            </select>
                            <input type="number" name="cantidad" min="1" placeholder="Cant." required
                                class="rounded-xl border-gray-200 text-xs py-1.5 focus:border-[#00C897] focus:ring-[#00C897]">
                        </div>
                        <input type="text" name="motivo" placeholder="Motivo (ej: Compra factura #12)" required
                            class="w-full rounded-xl border-gray-200 text-xs py-1.5 focus:border-[#00C897] focus:ring-[#00C897]">
                        
                        <button type="submit" class="w-full bg-gray-900 hover:bg-[#00C897] text-white text-xs font-bold py-2 rounded-xl transition">
                            Registrar Movimiento
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        @if($productos->hasPages())
            <div class="mt-6 pt-4 border-t border-gray-100">
                {{ $productos->links() }}
            </div>
        @endif
    </div>

    <!-- TABLA DE MOVIMIENTOS RECIENTES (KARDEX AUDITORÍA) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-bold text-gray-900 text-base">Auditoría de Movimientos (Kardex Reciente)</h3>
            <p class="text-xs text-gray-500">Historial de entradas, salidas y motivos registrados en el sistema</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/70 text-gray-700 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-3.5 px-6">Fecha & Hora</th>
                        <th class="py-3.5 px-6">Producto</th>
                        <th class="py-3.5 px-6">Tipo</th>
                        <th class="py-3.5 px-6 text-center">Cantidad</th>
                        <th class="py-3.5 px-6 text-center">Stock Anterior → Nuevo</th>
                        <th class="py-3.5 px-6">Motivo</th>
                        <th class="py-3.5 px-6">Responsable</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($movimientos as $mov)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-3.5 px-6 text-xs text-gray-400">{{ $mov->created_at }}</td>
                            <td class="py-3.5 px-6 font-bold text-gray-800">{{ $mov->producto->nombre ?? 'Producto eliminado' }}</td>
                            <td class="py-3.5 px-6">
                                @if($mov->tipo === 'entrada')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Entrada</span>
                                @elseif($mov->tipo === 'salida')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">Salida</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Ajuste</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-6 text-center font-black text-gray-900">{{ $mov->cantidad }}</td>
                            <td class="py-3.5 px-6 text-center text-xs font-semibold text-gray-500">
                                {{ $mov->stock_anterior }} → <strong class="text-gray-900">{{ $mov->stock_nuevo }}</strong>
                            </td>
                            <td class="py-3.5 px-6 text-xs text-gray-600">{{ $mov->motivo ?? 'Sin motivo especificado' }}</td>
                            <td class="py-3.5 px-6 text-xs font-medium text-gray-800">{{ $mov->usuario->nombre ?? 'Sistema' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400">No hay movimientos registrados en el Kardex.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection