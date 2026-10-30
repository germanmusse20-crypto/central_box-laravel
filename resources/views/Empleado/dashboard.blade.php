@extends('layouts.empleado')

@section('titulo', 'Centro de Operaciones - Central Box')

@section('contenido')
<div class="w-full space-y-6 max-w-7xl mx-auto">

    {{-- ============================================
         1. BANNER HERO: CENTRO DE OPERACIONES
         ============================================ --}}
    <div class="relative overflow-hidden p-8 sm:p-10 text-white shadow-xl"
     style="background: linear-gradient(135deg, #064e3b 0%, #047857 60%, #00C897 100%); border-radius: 24px;">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                {{-- Badge Superior --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-emerald-200 text-[11px] font-extrabold uppercase tracking-wider mb-3 border border-white/15">
                    CENTRO DE OPERACIONES
                </div>

                {{-- Saludo con el nombre del Empleado autenticado --}}
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-2">
                    {{ $saludo }}, <span class="text-emerald-200">{{ Auth::user()->nombre }}</span>
                </h1>

                <p class="text-emerald-100 text-sm max-w-xl font-normal opacity-90 leading-relaxed">
                    Gestiona ventas, cobros, existencias y comprobantes desde un solo lugar.
                </p>
            </div>

            {{-- Botón CTA: Nueva venta --}}
            <div class="flex-shrink-0">
                <a href="{{ route('empleado.ventas.create') }}" 
                   class="inline-flex items-center gap-2.5 bg-[#00C897] hover:bg-[#00b084] text-white font-bold text-sm py-3 px-6 rounded-2xl shadow-lg shadow-emerald-900/30 transition transform hover:-translate-y-0.5 active:scale-95 border border-white/20">
                    <i class="fa-solid fa-circle-plus text-base"></i> Nueva venta
                </a>
            </div>
        </div>

        {{-- Decoración sutil de fondo --}}
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    {{-- ============================================
         2. FILA DE 3 KPIS OPERATIVOS
         ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- KPI 1: Ventas del mes --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md transition">
            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                Ventas del mes
            </span>
            <div class="text-2xl sm:text-3xl font-black text-gray-900">
                $ {{ number_format($ventasMes, 0, ',', '.') }}
            </div>
        </div>

        {{-- KPI 2: Pedidos confirmados --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md transition">
            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                Pedidos confirmados
            </span>
            <div class="text-2xl sm:text-3xl font-black text-gray-900">
                {{ $pedidosConfirmados }}
            </div>
        </div>

        {{-- KPI 3: Productos sin stock --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:shadow-md transition">
            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                Productos sin stock
            </span>
            <div class="flex items-center gap-2">
                <span class="text-2xl sm:text-3xl font-black {{ $productosSinStock > 0 ? 'text-red-500' : 'text-gray-900' }}">
                    {{ $productosSinStock }}
                </span>
                @if($productosSinStock > 0)
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-600">Revisar</span>
                @endif
            </div>
        </div>

    </div>

    {{-- ============================================
         3. CUADRÍCULA DE 6 ACCIONES RÁPIDAS
         ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 pt-2">

        {{-- Acción 1: Crear venta --}}
        <a href="{{ route('empleado.ventas.create') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:border-emerald-300 hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#00C897] group-hover:bg-[#00C897] group-hover:text-white flex items-center justify-center text-xl mb-4 transition duration-200">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#00C897] transition mb-1">
                    Crear venta
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Selecciona productos y cliente.
                </p>
            </div>
        </a>

        {{-- Acción 2: Cobrar pedido --}}
        <a href="{{ route('empleado.ventas.create') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:border-emerald-300 hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#00C897] group-hover:bg-[#00C897] group-hover:text-white flex items-center justify-center text-xl mb-4 transition duration-200">
                    <i class="fa-solid fa-credit-card"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#00C897] transition mb-1">
                    Cobrar pedido
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Efectivo, tarjeta o transferencia.
                </p>
            </div>
        </a>

        {{-- Acción 3: Consultar catálogo --}}
        <a href="{{ route('empleado.productos.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:border-emerald-300 hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#00C897] group-hover:bg-[#00C897] group-hover:text-white flex items-center justify-center text-xl mb-4 transition duration-200">
                    <i class="fa-solid fa-table-cells"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#00C897] transition mb-1">
                    Consultar catálogo
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Encuentra productos disponibles.
                </p>
            </div>
        </a>

        {{-- Acción 4: Controlar stock --}}
        <a href="{{ route('empleado.stock.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:border-emerald-300 hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#00C897] group-hover:bg-[#00C897] group-hover:text-white flex items-center justify-center text-xl mb-4 transition duration-200">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#00C897] transition mb-1">
                    Controlar stock
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Detecta faltantes y reposición.
                </p>
            </div>
        </a>

        {{-- Acción 5: Ver historial --}}
        <a href="{{ route('empleado.ventas.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:border-emerald-300 hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#00C897] group-hover:bg-[#00C897] group-hover:text-white flex items-center justify-center text-xl mb-4 transition duration-200">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#00C897] transition mb-1">
                    Ver historial
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Busca ventas y estados.
                </p>
            </div>
        </a>

        {{-- Acción 6: Emitir comprobante --}}
        <a href="{{ route('empleado.ventas.index') }}" 
           class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-xs hover:border-emerald-300 hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#00C897] group-hover:bg-[#00C897] group-hover:text-white flex items-center justify-center text-xl mb-4 transition duration-200">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#00C897] transition mb-1">
                    Emitir comprobante
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Abre una factura registrada.
                </p>
            </div>
        </a>

    </div>

</div>
@endsection