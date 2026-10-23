@extends('layouts.admin')

@section('titulo', 'Inicio - Central Box')

@section('contenido')
<div class="space-y-8">

    <!-- 1. BANNER DE BIENVENIDA -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#1a1a2e] to-[#252542] p-8 text-white shadow-lg border border-gray-800">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-semibold mb-3 border border-emerald-500/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Sistema en línea
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight">
                    ¡Bienvenido, <span class="text-[#00C897]">{{ Auth::user()->nombre }}</span>! 👋
                </h1>
                <p class="text-gray-300 text-sm mt-1 max-w-xl">
                    Este es el resumen operativo de hoy en <strong>Central Box</strong>. Monitorea ingresos, gestiona el inventario y controla las ventas en tiempo real.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.ventas.create') }}" class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-3 px-5 rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-cart-plus text-base"></i> Nueva Venta Online
                </a>
            </div>
        </div>
        <!-- Decoración geométrica sutil de fondo -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- 2. TARJETAS DE KPIS FINANCIEROS Y OPERATIVOS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- KPI 1: Ingresos Totales -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ingresos Totales</p>
                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">$ {{ number_format($totalVentas, 0, ',', '.') }}</h3>
                    <p class="text-xs text-emerald-600 font-semibold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up"></i> {{ $conteoVentas }} ventas registradas
                    </p>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-emerald-50 text-[#00C897] flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>
        </div>

        <!-- KPI 2: Base Gravable (Subtotal) -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ventas Netas (Sin IVA)</p>
                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">$ {{ number_format($totalSubtotal, 0, ',', '.') }}</h3>
                    <p class="text-xs text-blue-600 font-semibold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-receipt"></i> IVA Recaudado: ${{ number_format($totalIva, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
        </div>

        <!-- KPI 3: Productos Activos -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Catálogo Activo</p>
                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">{{ $totalProductos }} ítems</h3>
                    <p class="text-xs text-purple-600 font-semibold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-truck-field"></i> {{ $totalProveedores }} Proveedores
                    </p>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-purple-50 text-purple-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-box-open"></i>
                </div>
            </div>
        </div>

        <!-- KPI 4: Usuarios / Clientes -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Comunidad</p>
                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">{{ $totalUsuarios }} Usuarios</h3>
                    <p class="text-xs text-amber-600 font-semibold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-user-check"></i> Clientes y Colaboradores
                    </p>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. ACCESOS RÁPIDOS OPERATIVOS -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Acciones Rápidas</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.productos.create') }}" class="p-4 rounded-xl border border-gray-100 hover:border-emerald-200 bg-gray-50/50 hover:bg-emerald-50/30 transition flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Crear Producto</h4>
                    <p class="text-[11px] text-gray-400">Nuevo ítem al catálogo</p>
                </div>
            </a>

            <a href="{{ route('admin.stock.index') }}" class="p-4 rounded-xl border border-gray-100 hover:border-blue-200 bg-gray-50/50 hover:bg-blue-50/30 transition flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Ajustar Stock</h4>
                    <p class="text-[11px] text-gray-400">Entrada/Salida Kardex</p>
                </div>
            </a>

            <a href="{{ route('admin.reportes.index') }}" class="p-4 rounded-xl border border-gray-100 hover:border-purple-200 bg-gray-50/50 hover:bg-purple-50/30 transition flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Ver Ganancias</h4>
                    <p class="text-[11px] text-gray-400">Reporte financiero</p>
                </div>
            </a>

            <a href="{{ route('admin.proveedores.create') }}" class="p-4 rounded-xl border border-gray-100 hover:border-orange-200 bg-gray-50/50 hover:bg-orange-50/30 transition flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fa-solid fa-truck"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Nuevo Proveedor</h4>
                    <p class="text-[11px] text-gray-400">Registrar distribuidor</p>
                </div>
            </a>
        </div>
    </div>

    <!-- 4. PANELES DETALLADOS: STOCK CRÍTICO & ÚLTIMAS VENTAS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Panel 1: Alerta de Stock Mínimo -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500 animate-ping"></span>
                        <h4 class="font-bold text-gray-900 text-base">Alerta de Stock Crítico</h4>
                    </div>
                    <a href="{{ route('admin.stock.index') }}" class="text-xs font-bold text-[#00C897] hover:underline flex items-center gap-1">
                        Ver Kardex <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>

                @if($productosBajoStock->isEmpty())
                    <div class="py-12 text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl mb-3">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <h5 class="text-sm font-bold text-gray-800">Inventario Óptimo</h5>
                        <p class="text-xs text-gray-400 mt-1">Todos los productos cuentan con existencias superiores al stock mínimo.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($productosBajoStock as $prod)
                            <div class="py-3.5 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 font-bold text-xs overflow-hidden">
                                        @if($prod->imagen)
                                            <img src="{{ asset('storage/' . $prod->imagen) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-box text-sm"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800 leading-tight">{{ $prod->nombre }}</p>
                                        <span class="text-xs text-gray-400">{{ $prod->categoria->nombre ?? 'Sin categoría' }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 text-xs font-extrabold rounded-full bg-red-50 text-red-600 border border-red-100">
                                        {{ $prod->stock }} disponibles
                                    </span>
                                    <p class="text-[10px] text-gray-400 mt-1">Mínimo sugerido: {{ $prod->stock_minimo }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-gray-100 mt-4 text-center">
                <a href="{{ route('admin.stock.index') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-800">
                    ¿Deseas registrar una entrada de mercancía? Haz clic aquí
                </a>
            </div>
        </div>

        <!-- Panel 2: Últimas Ventas Realizadas -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-[#00C897]"></i>
                        <h4 class="font-bold text-gray-900 text-base">Últimas Transacciones</h4>
                    </div>
                    <a href="{{ route('admin.ventas.index') }}" class="text-xs font-bold text-[#00C897] hover:underline flex items-center gap-1">
                        Historial Completo <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>

                @if($ultimasVentas->isEmpty())
                    <div class="py-12 text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-gray-50 text-gray-400 flex items-center justify-center text-xl mb-3">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <h5 class="text-sm font-bold text-gray-800">Sin ventas aún</h5>
                        <p class="text-xs text-gray-400 mt-1">Comienza registrando tu primera venta en el módulo POS.</p>
                        <a href="{{ route('admin.ventas.create') }}" class="mt-4 inline-block text-xs font-bold text-[#00C897] hover:underline">
                            + Crear primera venta
                        </a>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($ultimasVentas as $venta)
                            <div class="py-3.5 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                                        #{{ $venta->id_venta }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $venta->cliente->nombre ?? 'Consumidor Final' }}</p>
                                        <span class="text-xs text-gray-400 capitalize">{{ $venta->tipo_venta }} • {{ $venta->fecha }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-gray-900">$ {{ number_format($venta->total, 0, ',', '.') }}</p>
                                    <span class="inline-block mt-0.5 px-2 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-700 capitalize">
                                        {{ $venta->estado }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-gray-100 mt-4 text-center">
                <a href="{{ route('admin.reportes.index') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-800">
                    Ver balance detallado de utilidades del mes →
                </a>
            </div>
        </div>

    </div>

</div>
@endsection