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

                    {{-- Acciones según el estado del método --}}
                    @if($esActivo)
                        {{-- Botón que abre el Modal de advertencia --}}
                        <button type="button"
                                onclick="abrirModalDesactivar('{{ $metodo->id }}', '{{ addslashes($metodo->nombre) }}')"
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-1.5 px-3.5 rounded-xl transition active:scale-95 cursor-pointer"
                                title="Deshabilitar este método de pago">
                            <i class="fa-solid fa-power-off text-[11px]"></i> Desactivar
                        </button>
                    @else
                        {{-- Para reactivar, se envía directamente el formulario --}}
                        <form action="{{ route('admin.metodos-pago.toggle', $metodo) }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-[#00C897] hover:bg-[#009e77] py-1.5 px-3.5 rounded-xl transition shadow-sm active:scale-95 cursor-pointer"
                                    title="Habilitar este método de pago">
                                <i class="fa-solid fa-check text-[11px]"></i> Activar
                            </button>
                        </form>
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
{{-- =========================================================
     MODAL COMPACTO Y REDONDEADO: CONFIRMACIÓN DE DESACTIVACIÓN
     ========================================================= --}}
<div id="modalDesactivarMetodo" 
     style="display: none; position: fixed; inset: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px; box-sizing: border-box;"
     onclick="cerrarModalDesactivarPorFondo(event)">
    
    {{-- Tarjeta Cuadrada y Redondeada Centrada (max-width: 440px) --}}
    <div class="caja-modal-alerta" 
         style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 28px; padding: 36px 32px 30px; box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(226, 232, 240, 0.8); text-align: center; position: relative; margin: auto; box-sizing: border-box;"
         onclick="event.stopPropagation()">
        
        {{-- Botón Circular Cerrar (✕) --}}
        <button type="button" onclick="cerrarModalDesactivar()" 
                style="position: absolute; top: 20px; right: 20px; width: 34px; height: 34px; border-radius: 50%; background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b; font-size: 13px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                onmouseover="this.style.background='#fee2e2'; this.style.color='#dc2626'; this.style.borderColor='#fca5a5';"
                onmouseout="this.style.background='#f8fafc'; this.style.color='#64748b'; this.style.borderColor='#e2e8f0';"
                title="Cerrar ventana">
            ✕
        </button>

        {{-- Ícono de Alerta en Círculo Rojo con Sombra Suave --}}
        <div style="width: 72px; height: 72px; border-radius: 24px; background: #fef2f2; border: 2px solid #fee2e2; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; color: #dc2626; font-size: 28px; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.15);">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        {{-- Badge Superior --}}
        <div style="margin-bottom: 8px;">
            <span style="display: inline-block; background: #fef2f2; color: #dc2626; font-size: 11px; font-weight: 800; letter-spacing: 0.8px; text-transform: uppercase; padding: 4px 14px; border-radius: 999px; border: 1px solid rgba(239, 68, 68, 0.2);">
                ⚠️ Alerta de Seguridad
            </span>
        </div>

        {{-- Título Principal --}}
        <h3 style="font-size: 21px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0; line-height: 1.3;">
            ¿Desactivar método de pago?
        </h3>

        {{-- Mensaje Informativo --}}
        <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin: 0 0 26px 0; padding: 0 4px;">
            Estás a punto de desactivar <strong id="nombreMetodoModal" style="color: #0f172a; font-weight: 700;">este canal</strong>.<br>
            Al desactivarlo, los clientes <strong style="color: #dc2626;">ya no podrán pagar</strong> por este medio en la tienda Central Box.
        </p>

        {{-- Formulario y Botones de Acción --}}
        <form id="formConfirmarDesactivar" method="POST" action="">
            @csrf
            
            <div style="display: flex; flex-direction: column; gap: 10px;">
                
                {{-- Botón Rojo de Confirmar (Elegante y Proporcionado) --}}
                <button type="submit" 
                        style="width: 100%; padding: 13px 20px; border-radius: 14px; border: none; background: #dc2626; color: #ffffff; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 10px 22px rgba(220, 38, 38, 0.32); transition: all 0.2s;"
                        onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.background='#dc2626'; this.style.transform='translateY(0)';">
                    <i class="fa-solid fa-power-off text-xs"></i> Confirmar Desactivación
                </button>

                {{-- Botón Cancelar Secundario --}}
                <button type="button" onclick="cerrarModalDesactivar()"
                        style="width: 100%; padding: 11px 20px; border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff; color: #64748b; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.2s;"
                        onmouseover="this.style.background='#f8fafc'; this.style.color='#0f172a';"
                        onmouseout="this.style.background='#ffffff'; this.style.color='#64748b';">
                    Cancelar y mantener activo
                </button>

            </div>

        </form>

    </div>
</div>

{{-- Estilos de Animación de Entrada Suave --}}
<style>
    @keyframes animarEntradaAlerta {
        from {
            opacity: 0;
            transform: scale(0.92) translateY(14px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    .caja-modal-alerta {
        animation: animarEntradaAlerta 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
</style>

{{-- Lógica JavaScript Directa y Confiable --}}
<script>
    // 1. Abrir Modal pasando ID y Nombre
    function abrirModalDesactivar(id, nombre) {
        const modal = document.getElementById('modalDesactivarMetodo');
        const form = document.getElementById('formConfirmarDesactivar');
        const spanNombre = document.getElementById('nombreMetodoModal');

        // URL exacta que envía la petición POST
        form.action = "{{ url('admin/metodos-pago') }}/" + id + "/toggle";

        // Nombre del canal resaltado
        spanNombre.textContent = '"' + nombre + '"';

        // Mostramos en modo flex centrado
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    // 2. Cerrar Modal
    function cerrarModalDesactivar() {
        const modal = document.getElementById('modalDesactivarMetodo');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    // Cerrar al hacer clic en el fondo oscuro
    function cerrarModalDesactivarPorFondo(event) {
        if (event.target.id === 'modalDesactivarMetodo') {
            cerrarModalDesactivar();
        }
    }

    // Cerrar con la tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModalDesactivar();
        }
    });
</script>
@endsection