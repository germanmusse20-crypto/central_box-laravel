@extends('layouts.admin')

@section('titulo', 'Reporte & Ganancias - Central Box')

@section('contenido')
<div class="space-y-8">

    <!-- CABECERA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-file-invoice-dollar text-[#00C897]"></i> Inteligencia de Negocio
            </div>
            <h2 class="text-2xl font-black text-gray-900">Reporte de Ventas & Ganancias</h2>
            <p class="text-xs text-gray-500 mt-0.5">Consulta la rentabilidad de Central Box en cualquier intervalo de tiempo</p>
        </div>

        <!-- FORMULARIO DE FILTRO POR FECHAS -->
        <form method="GET" action="{{ route('admin.reportes.index') }}" class="flex flex-wrap items-center gap-3">
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-0.5">Desde</label>
                <input type="date" name="fecha_inicio" value="{{ $fechaInicio }}"
                    class="rounded-xl border-gray-200 text-xs py-1.5 focus:border-[#00C897] focus:ring-[#00C897]">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-0.5">Hasta</label>
                <input type="date" name="fecha_fin" value="{{ $fechaFin }}"
                    class="rounded-xl border-gray-200 text-xs py-1.5 focus:border-[#00C897] focus:ring-[#00C897]">
            </div>
            <div class="self-end">
                <button type="submit" class="bg-[#00C897] hover:bg-[#009e77] text-white text-xs font-bold py-2 px-4 rounded-xl transition shadow-sm">
                    <i class="fa-solid fa-filter"></i> Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- TARJETAS DE CONSOLIDADO DEL PERIODO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Ingresos -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ingresos Totales (Bruto)</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">$ {{ number_format($totalIngresos, 0, ',', '.') }}</h3>
            <p class="text-xs text-emerald-600 font-medium mt-1">Con IVA incluido</p>
        </div>

        <!-- Ventas Netas -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ventas Netas (Subtotal)</p>
            <h3 class="text-2xl font-black text-blue-600 mt-1">$ {{ number_format($totalSubtotal, 0, ',', '.') }}</h3>
            <p class="text-xs text-blue-500 font-medium mt-1">Utilidad base antes de impuestos</p>
        </div>

        <!-- IVA Recaudado -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">IVA Recaudado (19%)</p>
            <h3 class="text-2xl font-black text-purple-600 mt-1">$ {{ number_format($totalIvaRecaudado, 0, ',', '.') }}</h3>
            <p class="text-xs text-purple-500 font-medium mt-1">Obligación fiscal acumulada</p>
        </div>

        <!-- Cantidad de Transacciones -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Transacciones Realizadas</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $cantidadVentas }}</h3>
            <p class="text-xs text-amber-500 font-medium mt-1">Órdenes procesadas en el periodo</p>
        </div>

    </div>

    <!-- SECCIÓN: PRODUCTOS MÁS VENDIDOS -->
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <h3 class="text-base font-black text-gray-900 mb-1">Top 5 Productos Más Vendidos</h3>
        <p class="text-xs text-gray-400 mb-6">Artículos con mayor rotación en el periodo seleccionado</p>

        <div class="space-y-4">
            @forelse($topProductos as $idx => $item)
                <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/70 border border-gray-100">
                    <div class="flex items-center gap-4">
                        <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-black text-xs flex items-center justify-center">
                            #{{ $idx + 1 }}
                        </span>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900">{{ $item->producto->nombre ?? 'Producto eliminado' }}</h4>
                            <p class="text-xs text-gray-400">Total vendido: <strong class="text-gray-700">{{ $item->total_vendido }} unidades</strong></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-black text-gray-900">$ {{ number_format($item->dinero_generado, 0, ',', '.') }}</p>
                        <span class="text-[10px] text-gray-400">Generado</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400">
                    <p class="text-xs">No hay datos de ventas en este rango de fechas.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection