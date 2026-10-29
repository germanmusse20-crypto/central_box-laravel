@extends('layouts.admin')

@section('titulo', 'Métodos de Pago - Central Box')

@section('contenido')
<div class="w-full space-y-6">

    {{-- ============================================
         CAJA 1: CABECERA Y ESTADÍSTICAS RÁPIDAS
         ============================================ --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        
        {{-- Título e Ícono --}}
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-credit-card text-[#00C897] text-xl"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">
                    <i class="fa-solid fa-sliders text-[#00C897]"></i> Configuración de Pagos
                </div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Métodos de Pago</h2>
                <p class="text-xs text-gray-500 mt-0.5">Controla qué pasarelas y medios de cobro están habilitados para tus clientes</p>
            </div>
        </div>

        {{-- Mini tarjetas de resumen --}}
        <div class="flex items-center gap-3">
            <div class="bg-gray-50 border border-gray-100 px-4 py-2 rounded-xl text-center">
                <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Canales</span>
                <span class="text-lg font-black text-gray-800">{{ $metodos->count() }}</span>
            </div>
            <div class="bg-emerald-50/60 border border-emerald-100 px-4 py-2 rounded-xl text-center">
                <span class="block text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Habilitados</span>
                <span class="text-lg font-black text-emerald-600">
                    {{ $metodos->filter(fn($m) => in_array($m->estado, ['activo', 'active']))->count() }}
                </span>
            </div>
        </div>

    </div>

    {{-- ============================================
         MENSAJE FLASH DE ÉXITO
         ============================================ --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2 font-medium">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-sm">✕</button>
        </div>
    @endif

    {{-- ============================================
         CUADRÍCULA DE TARJETAS DE MÉTODOS DE PAGO
         ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($metodos as $metodo)
            @php
                $esActivo = in_array($metodo->estado, ['activo', 'active']);
                $nombreUpper = strtoupper($metodo->nombre);

                // Configuración visual según el método de pago
                if (str_contains($nombreUpper, 'EFECTIVO')) {
                    $icono = 'fa-money-bill-wave';
                    $colorBg = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                } elseif (str_contains($nombreUpper, 'NEQUI')) {
                    $icono = 'fa-mobile-screen-button';
                    $colorBg = 'bg-purple-50 text-purple-600 border-purple-200';
                } elseif (str_contains($nombreUpper, 'DAVIPLATA')) {
                    $icono = 'fa-wallet';
                    $colorBg = 'bg-red-50 text-red-600 border-red-200';
                } elseif (str_contains($nombreUpper, 'TRANSFERENCIA')) {
                    $icono = 'fa-building-columns';
                    $colorBg = 'bg-blue-50 text-blue-600 border-blue-200';
                } else {
                    $icono = 'fa-credit-card';
                    $colorBg = 'bg-slate-50 text-slate-700 border-slate-200';
                }
            @endphp

            <div class="bg-white rounded-2xl border {{ $esActivo ? 'border-gray-100 shadow-sm' : 'border-gray-200 bg-gray-50/40 opacity-75' }} p-6 flex flex-col justify-between transition hover:shadow-md">
                
                {{-- Parte Superior: Ícono + Badge Estado --}}
                <div>
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl border flex items-center justify-center text-xl {{ $colorBg }}">
                            <i class="fa-solid {{ $icono }}"></i>
                        </div>

                        {{-- Badge Estado --}}
                        @if($esActivo)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Habilitado
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Deshabilitado
                            </span>
                        @endif
                    </div>

                    {{-- Nombre y Descripción --}}
                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $metodo->nombre }}</h3>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-4 leading-relaxed">
                        {{ $metodo->descripcion ?: 'Canal de cobro disponible para ventas en Central Box.' }}
                    </p>
                </div>

                {{-- Parte Inferior: Conteo de Pagos + Botón Toggle --}}
                <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-3">
                    <div class="text-[11px] text-gray-400">
                        <i class="fa-solid fa-receipt text-gray-300 mr-1"></i>
                        <span class="font-bold text-gray-700">{{ $metodo->pagos_count ?? 0 }}</span> pagos
                    </div>

                    {{-- Formulario para cambiar estado (Toggle) --}}
                    <form action="{{ route('admin.metodos-pago.toggle', $metodo) }}" method="POST" class="m-0">
                        @csrf
                        @if($esActivo)
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-1.5 px-3.5 rounded-xl transition active:scale-95"
                                    title="Deshabilitar este método de pago">
                                <i class="fa-solid fa-power-off text-[11px]"></i> Desactivar
                            </button>
                        @else
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-[#00C897] hover:bg-[#009e77] py-1.5 px-3.5 rounded-xl transition shadow-sm active:scale-95"
                                    title="Habilitar este método de pago">
                                <i class="fa-solid fa-check text-[11px]"></i> Activar
                            </button>
                        @endif
                    </form>
                </div>

            </div>

        @empty
            <div class="col-span-full bg-white p-12 rounded-2xl border border-gray-100 text-center text-gray-400">
                <i class="fa-solid fa-credit-card text-4xl mb-3 opacity-30"></i>
                <p class="text-sm font-semibold text-gray-600">No se encontraron métodos de pago</p>
            </div>
        @endforelse

    </div>

</div>
@endsection