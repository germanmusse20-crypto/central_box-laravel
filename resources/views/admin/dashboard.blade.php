@extends('layouts.admin')

@section('titulo', 'Inicio - Central Box')

@section('contenido')
<div class="space-y-8">

    {{-- Saludo dinámico según la hora legal de Colombia --}}
    @php
        $horaColombia = \Carbon\Carbon::now('America/Bogota')->hour;
        if ($horaColombia >= 5 && $horaColombia < 12) {
            $saludo = 'Buenos días';
        } elseif ($horaColombia >= 12 && $horaColombia < 18) {
            $saludo = 'Buenas tardes';
        } else {
            $saludo = 'Buenas noches';
        }
    @endphp

    <!-- 1. BANNER DE BIENVENIDA -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#1a1a2e] to-[#252542] p-8 text-white shadow-lg border border-gray-800">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-semibold mb-3 border border-emerald-500/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Sistema en línea
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight">
                    {{ $saludo }}, <span class="text-[#00C897]">{{ Auth::user()->nombre }}</span>
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
                <button type="button" onclick="abrirModalCrearProducto()" class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-emerald-200 bg-gray-50/50 hover:bg-emerald-50/30 transition flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition shadow-xs">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Crear Producto</h4>
                    <p class="text-[11px] text-gray-400">Agrega prodcutos al catálogo</p>
                </div>
            </button>

            {{-- Botón 2: Ajustar Stock (Abre su propio modal de inventario) --}}
            <button type="button" onclick="abrirModalAjustarStock()" class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-blue-200 bg-gray-50/50 hover:bg-blue-50/30 transition flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition shadow-xs">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Ajustar Stock</h4>
                    <p class="text-[11px] text-gray-400">Gestión del inventario</p>
                </div>
            </button>
            
            {{-- Botón 3: Ver Ganancias (Abre modal desde la izquierda) --}}
            <button type="button" onclick="abrirModalVerGanancias()" class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-purple-200 bg-gray-50/50 hover:bg-purple-50/30 transition flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-110 transition shadow-xs">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Ver Ganancias</h4>
                    <p class="text-[11px] text-gray-400">Reporte financiero</p>
                </div>
            </button>

            {{-- Botón 4: Nuevo Proveedor (Abre modal desde la derecha) --}}
            <button type="button" onclick="abrirModalNuevoProveedor()" class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-orange-200 bg-gray-50/50 hover:bg-orange-50/30 transition flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center group-hover:scale-110 transition shadow-xs">
                    <i class="fa-solid fa-truck"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Nuevo Proveedor</h4>
                    <p class="text-[11px] text-gray-400">Registrar distribuidor</p>
                </div>
            </button>
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
                        Ver Stock <i class="fa-solid fa-chevron-right text-[10px]"></i>
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
                </a>
            </div>
        </div>

    </div>

</div>
    {{-- ============================================
         CONSULTAS DE DATOS PARA LOS MODALES
         ============================================ --}}
    @php
        $categorias = \App\Models\Categoria::where('estado', 'active')->orderBy('nombre')->get();
        $productosInventario = \App\Models\Producto::orderBy('nombre')->get();
    @endphp

{{-- ============================================
     ESTILOS Y ANIMACIONES HD (CERRADO CORRECTAMENTE)
     ============================================ --}}
<style>
    /* Fondo oscuro suave */
    @keyframes animarFondoHD {
        from { opacity: 0; backdrop-filter: blur(0px); }
        to { opacity: 1; backdrop-filter: blur(8px); }
    }

    /* 1 y 2: Entrada desde abajo hacia el centro */
    @keyframes animarTarjetaHD {
        0% { opacity: 0; transform: translateY(110px) scale(0.92); filter: blur(8px); }
        60% { filter: blur(2px); }
        100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0px); }
    }

    /* 3: Entrada desde la IZQUIERDA hacia el centro */
    @keyframes animarTarjetaIzquierdaHD {
        0% { opacity: 0; transform: translateX(-150px) scale(0.92); filter: blur(8px); }
        60% { filter: blur(2px); }
        100% { opacity: 1; transform: translateX(0) scale(1); filter: blur(0px); }
    }

    /* 4: Entrada desde la DERECHA hacia el centro */
    @keyframes animarTarjetaDerechaHD {
        0% { opacity: 0; transform: translateX(150px) scale(0.92); filter: blur(8px); }
        60% { filter: blur(2px); }
        100% { opacity: 1; transform: translateX(0) scale(1); filter: blur(0px); }
    }

    /* Activación del fondo */
    #modalCrearProducto.animar-hd,
    #modalAjustarStock.animar-hd,
    #modalVerGanancias.animar-hd,
    #modalNuevoProveedor.animar-hd {
        animation: animarFondoHD 350ms ease-out both;
    }

    /* Asignación de animaciones */
    #modalCrearProducto.animar-hd > div,
    #modalAjustarStock.animar-hd > div {
        animation: animarTarjetaHD 450ms cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    #modalVerGanancias.animar-hd > div {
        animation: animarTarjetaIzquierdaHD 450ms cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    #modalNuevoProveedor.animar-hd > div {
        animation: animarTarjetaDerechaHD 450ms cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @media (prefers-reduced-motion: reduce) {
        #modalCrearProducto.animar-hd > div,
        #modalAjustarStock.animar-hd > div,
        #modalVerGanancias.animar-hd > div,
        #modalNuevoProveedor.animar-hd > div {
            animation: none !important;
        }
    }
</style>

    {{-- ============================================
         MODAL 1: CREAR PRODUCTO
         ============================================ --}}
    <div id="modalCrearProducto"
         class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
         role="dialog" aria-modal="true" aria-labelledby="modalCrearProductoTitulo">

        <div class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">
            <div class="flex items-start justify-between border-b border-slate-100 bg-gradient-to-r from-emerald-50 via-white to-white px-6 py-5 sm:px-8">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-[#00C897]">
                        <i class="fa-solid fa-box-open text-xl"></i>
                    </div>
                    <div>
                        <h3 id="modalCrearProductoTitulo" class="text-xl font-bold tracking-tight text-slate-900">Agregar Producto</h3>
                        <p class="mt-0.5 text-xs text-slate-500">Ingresa la información del nuevo producto para el catálogo de Central Box.</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalCrearProducto()" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-6 sm:px-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Producto *</label>
                    <input type="text" name="nombre" placeholder="Ej: Memoria USB 64GB..." required class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Categoría *</label>
                    <select name="categoria_id" required class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Precio Base (Sin IVA) *</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-2.5 text-gray-400 font-bold text-sm">$</span>
                            <input type="number" step="0.01" name="precio" value="0" required class="w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">IVA (%) *</label>
                        <input type="number" step="0.01" name="iva" value="19.00" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Stock Inicial *</label>
                        <input type="number" name="stock" value="10" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Stock Mínimo (Alerta) *</label>
                        <input type="number" name="stock_minimo" value="5" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Fotografía del Producto</label>
                    <input type="file" name="imagen" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                    <button type="button" onclick="cerrarModalCrearProducto()" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Cancelar</button>
                    <button type="submit" class="rounded-xl bg-[#00C897] hover:bg-[#009e77] px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-500/20 transition focus:outline-none focus:ring-4 focus:ring-emerald-100"><i class="fa-solid fa-floppy-disk mr-2"></i> Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================================
         MODAL 2: GESTIÓN DE STOCK
         ============================================ --}}
    <div id="modalAjustarStock"
         class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
         role="dialog" aria-modal="true" aria-labelledby="modalAjustarStockTitulo">

        <div class="my-auto max-h-[90vh] w-full max-w-xl overflow-y-auto rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">
            <div class="flex items-start justify-between border-b border-slate-100 bg-gradient-to-r from-emerald-50 via-white to-white px-6 py-5 sm:px-8">
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-boxes-stacked text-[#00C897]"></i> Control de Existencias
                    </div>
                    <h3 id="modalAjustarStockTitulo" class="text-2xl font-black text-gray-900">Gestión de Stock</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Realiza ajustes directos de inventario.</p>
                </div>
                <button type="button" onclick="cerrarModalAjustarStock()" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form id="formAjustarStockModal" method="POST" onsubmit="return procesarEnvioAjuste(this)" class="px-6 py-6 sm:px-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Producto a Ajustar *</label>
                    <select id="select_producto_ajuste" required class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100 font-medium">
                        <option value="">Selecciona el producto</option>
                        @forelse($productosInventario as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->nombre }} (Stock actual: {{ $prod->stock }} uds)</option>
                        @empty
                            <option value="" disabled>⚠️ No hay productos en catálogo</option>
                        @endforelse
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tipo de Movimiento *</label>
                        <select name="tipo" required class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100 font-semibold">
                            <option value="entrada">+ Entrada (Compra / Reposición)</option>
                            <option value="salida">- Salida (Baja / Merma)</option>
                            <option value="ajuste">Ajuste Fijo (Inventario manual)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Cantidad *</label>
                        <input type="number" name="cantidad" min="1" placeholder="Ej: 10" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Motivo del Ajuste *</label>
                    <input type="text" name="motivo" placeholder="Ej: Factura compra proveedor, conteo físico..." required class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                </div>
                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                    <button type="button" onclick="cerrarModalAjustarStock()" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Cancelar</button>
                    <button type="submit" class="rounded-xl bg-[#00C897] hover:bg-[#009e77] px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-500/20 transition focus:outline-none focus:ring-4 focus:ring-emerald-100"><i class="fa-solid fa-boxes-stacked mr-2"></i> Registrar Movimiento</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================================
         MODAL 3: VER GANANCIAS (Izquierda -> Centro)
         ============================================ --}}
    <div id="modalVerGanancias"
         class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
         role="dialog" aria-modal="true" aria-labelledby="modalVerGananciasTitulo">

        <div class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">
            <div class="flex items-start justify-between border-b border-slate-100 bg-gradient-to-r from-purple-50 via-white to-white px-6 py-5 sm:px-8">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-purple-100 text-purple-600">
                        <i class="fa-solid fa-chart-pie text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">
                            <i class="fa-solid fa-file-invoice-dollar text-purple-500"></i> Inteligencia de Negocio
                        </div>
                        <h3 id="modalVerGananciasTitulo" class="text-2xl font-black text-gray-900">Reporte de Ganancias</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Consolidado financiero acumulado en tiempo real.</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalVerGanancias()" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="px-6 py-6 sm:px-8 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100">
                        <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Ingresos Totales</span>
                        <h4 class="text-xl font-black text-[#00C897] mt-1">$ {{ number_format($totalVentas, 0, ',', '.') }}</h4>
                        <p class="text-[10px] text-gray-500 mt-1">Con IVA incluido</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-blue-50/50 border border-blue-100">
                        <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Ventas Netas</span>
                        <h4 class="text-xl font-black text-blue-600 mt-1">$ {{ number_format($totalSubtotal, 0, ',', '.') }}</h4>
                        <p class="text-[10px] text-gray-500 mt-1">Utilidad antes de IVA</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-purple-50/50 border border-purple-100">
                        <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">IVA Recaudado (19%)</span>
                        <h4 class="text-xl font-black text-purple-600 mt-1">$ {{ number_format($totalIva, 0, ',', '.') }}</h4>
                        <p class="text-[10px] text-gray-500 mt-1">Obligación fiscal</p>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white text-gray-600 border border-gray-200 flex items-center justify-center font-bold text-xs">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800">Transacciones Realizadas</p>
                            <p class="text-[11px] text-gray-500">Pedidos registrados con éxito</p>
                        </div>
                    </div>
                    <span class="text-lg font-black text-gray-900">{{ $conteoVentas }}</span>
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="cerrarModalVerGanancias()" class="w-full sm:w-auto rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">Cerrar</button>
                    <a href="{{ route('admin.reportes.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-purple-600 hover:bg-purple-700 px-6 py-2.5 text-sm font-bold text-slate-600 shadow-md">Ver informe completo</a>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         MODAL 4: NUEVO PROVEEDOR (Derecha -> Centro)
         ============================================ --}}
    <div id="modalNuevoProveedor"
         class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
         role="dialog" aria-modal="true" aria-labelledby="modalNuevoProveedorTitulo">

        <div class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">
            <div class="flex items-start justify-between border-b border-slate-100 bg-gradient-to-r from-orange-50 via-white to-white px-6 py-5 sm:px-8">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                        <i class="fa-solid fa-truck-moving text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">
                            <i class="fa-solid fa-handshake text-orange-500"></i> Red de Distribución
                        </div>
                        <h3 id="modalNuevoProveedorTitulo" class="text-2xl font-black text-gray-900">Registrar Proveedor</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Ingresa los datos comerciales de tus aliados y distribuidores.</p>
                    </div>
                </div>
                <button type="button" onclick="cerrarModalNuevoProveedor()" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('admin.proveedores.store') }}" method="POST" autocomplete="off" class="px-6 py-6 sm:px-8 space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nombre de la Empresa *</label>
                        <input type="text" name="nombre" required placeholder="Ej: Distribuidora Nacional S.A.S." class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">NIT / RUC</label>
                        <input type="text" name="ruc" placeholder="Ej: 900.123.456-7" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Persona de Contacto</label>
                        <input type="text" name="contacto" placeholder="Ej: Carlos Gómez (Ventas)" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Teléfono / Celular</label>
                        <input type="text" name="telefono" placeholder="Ej: +57 310 987 6543" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Correo Electrónico</label>
                        <input type="email" name="email" placeholder="ventas@proveedor.com" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Estado *</label>
                        <select name="estado" required class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                            <option value="active">🟢 Activo</option>
                            <option value="inactive">🔴 Inactivo</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Dirección de Bodega</label>
                    <input type="text" name="direccion" placeholder="Ej: Calle 15 # 40-20, Bodega 4" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">
                </div>
                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                    <button type="button" onclick="cerrarModalNuevoProveedor()" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">Cancelar</button>
                    <button type="submit" class="rounded-xl bg-orange-500 hover:bg-orange-600 px-6 py-2.5 text-sm font-bold text-slate-600 shadow-md shadow-orange-500/20 transition focus:outline-none focus:ring-4 focus:ring-orange-100"><i class="fa-solid fa-truck mr-2"></i> Guardar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- ============================================
     JAVASCRIPT: DISPARADORES Y CONTROL DE LOS 4 MODALES
     ============================================ --}}
@push('scripts')
<script>
    // --- 1. MODAL CREAR PRODUCTO ---
    function abrirModalCrearProducto() {
        const modal = document.getElementById('modalCrearProducto');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.classList.remove('animar-hd');
        void modal.offsetWidth;
        modal.classList.add('animar-hd');
    }
    function cerrarModalCrearProducto() {
        const modal = document.getElementById('modalCrearProducto');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.classList.remove('animar-hd');
    }
    document.getElementById('modalCrearProducto')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalCrearProducto();
    });

    // --- 2. MODAL AJUSTAR STOCK ---
    function abrirModalAjustarStock() {
        const modal = document.getElementById('modalAjustarStock');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.classList.remove('animar-hd');
        void modal.offsetWidth;
        modal.classList.add('animar-hd');
    }
    function cerrarModalAjustarStock() {
        const modal = document.getElementById('modalAjustarStock');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.classList.remove('animar-hd');
    }
    function procesarEnvioAjuste(formulario) {
        const prodId = document.getElementById('select_producto_ajuste').value;
        if (!prodId) {
            alert('Por favor selecciona un producto.');
            return false;
        }
        formulario.action = '/admin/stock/' + prodId + '/ajustar';
        return true;
    }
    document.getElementById('modalAjustarStock')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalAjustarStock();
    });

    // --- 3. MODAL VER GANANCIAS (Izquierda -> Centro) ---
    function abrirModalVerGanancias() {
        const modal = document.getElementById('modalVerGanancias');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.classList.remove('animar-hd');
        void modal.offsetWidth;
        modal.classList.add('animar-hd');
    }
    function cerrarModalVerGanancias() {
        const modal = document.getElementById('modalVerGanancias');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.classList.remove('animar-hd');
    }
    document.getElementById('modalVerGanancias')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalVerGanancias();
    });

    // --- 4. MODAL NUEVO PROVEEDOR (Derecha -> Centro) ---
    function abrirModalNuevoProveedor() {
        const modal = document.getElementById('modalNuevoProveedor');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.classList.remove('animar-hd');
        void modal.offsetWidth;
        modal.classList.add('animar-hd');
    }
    function cerrarModalNuevoProveedor() {
        const modal = document.getElementById('modalNuevoProveedor');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.classList.remove('animar-hd');
    }
    document.getElementById('modalNuevoProveedor')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalNuevoProveedor();
    });

    // --- TECLA ESCAPE PARA CERRAR CUALQUIER MODAL ACTIVO ---
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModalCrearProducto();
            cerrarModalAjustarStock();
            cerrarModalVerGanancias();
            cerrarModalNuevoProveedor();
        }
    });
</script>
@endpush