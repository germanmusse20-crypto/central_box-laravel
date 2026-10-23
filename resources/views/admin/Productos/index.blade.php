@extends('layouts.admin')

@section('titulo', 'Productos e Insumos - Central Box')

@section('contenido')
<div class="space-y-6">

    <!-- CABECERA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-box-open text-[#00C897]"></i> Gestión de Inventario
            </div>
            <h2 class="text-2xl font-black text-gray-900">Productos e Insumos</h2>
            <p class="text-xs text-gray-500 mt-0.5">Controla precios de venta, stock disponible y niveles de reorden</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.stock.index') }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold py-2.5 px-4 rounded-xl transition">
                <i class="fa-solid fa-boxes-stacked"></i> Ver Kardex
            </a>
            <a href="{{ route('admin.productos.create') }}" class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-4 rounded-xl transition shadow-md shadow-emerald-500/20">
                <i class="fa-solid fa-plus"></i> Nuevo Producto
            </a>
        </div>
    </div>

    <!-- TABLA DE PRODUCTOS -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/70 text-gray-700 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6">Producto</th>
                        <th class="py-4 px-6">Categoría</th>
                        <th class="py-4 px-6">Precio (Sin IVA)</th>
                        <th class="py-4 px-6">IVA</th>
                        <th class="py-4 px-6 text-center">Stock Actual</th>
                        <th class="py-4 px-6 text-center">Estado</th>
                        <th class="py-4 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($productos as $prod)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        @if($prod->imagen)
                                            <img src="{{ asset('storage/' . $prod->imagen) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-box text-gray-400"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 leading-tight">{{ $prod->nombre }}</p>
                                        <span class="text-[11px] text-gray-400">Mínimo: {{ $prod->stock_minimo }} uds</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ $prod->categoria->nombre ?? 'Sin categoría' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-gray-900">$ {{ number_format($prod->precio, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-xs text-gray-500">{{ $prod->iva }}%</td>
                            <td class="py-4 px-6 text-center">
                                @if($prod->stock <= $prod->stock_minimo)
                                    <span class="px-2.5 py-1 text-xs font-extrabold rounded-full bg-red-100 text-red-700 animate-pulse">
                                        {{ $prod->stock }} (Crítico)
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        {{ $prod->stock }} disponibles
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($prod->activo)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">Activo</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-200 text-gray-600">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.productos.edit', $prod->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.productos.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este producto?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400">No hay productos registrados en el inventario.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($productos->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $productos->links() }}
            </div>
        @endif
    </div>

</div>
@endsection