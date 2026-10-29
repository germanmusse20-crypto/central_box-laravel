@extends('layouts.admin')

@section('titulo', 'Listado de Proveedores - Central Box')

@section('contenido')
<div class="w-full space-y-6">

    {{-- ============================================
         CAJA 1: CABECERA (TÍTULO + BOTÓN REGISTRAR)
         ============================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-truck-field text-[#00C897] text-xl"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">
                    <i class="fa-solid fa-boxes-packing text-[#00C897]"></i> Gestión de Abastecimiento
                </div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Listado de Proveedores</h2>
                <p class="text-xs text-gray-500 mt-0.5">Administra los aliados comerciales, compras y líneas de crédito de Central Box</p>
            </div>
        </div>

        {{-- Botón para ir al formulario de registro --}}
        <a href="{{ route('admin.proveedores.create') }}"
           class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-5 rounded-xl transition shadow-md shadow-emerald-500/20 active:scale-95">
            <i class="fa-solid fa-plus"></i> Registrar Proveedor
        </a>
    </div>

    {{-- ============================================
         MENSAJE FLASH DE ÉXITO
         ============================================ --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center justify-between">
            <div class="flex items-center gap-2 font-medium">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-sm">✕</button>
        </div>
    @endif

    {{-- ============================================
         CAJA 2: BARRA DE BÚSQUEDA EN TIEMPO REAL
         ============================================ --}}
    <div class="bg-white px-6 py-4 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-4">
            
            {{-- Buscador con lupa a la derecha --}}
            <div class="relative flex-1" style="position: relative; flex: 1;">
                <input type="text" id="buscadorProveedor" placeholder="Buscar proveedor por empresa, contacto o NIT..."
                    class="w-full pl-4 pr-10 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50 text-gray-800"
                    style="width: 100%; padding-left: 16px; padding-right: 42px; padding-top: 10px; padding-bottom: 10px; font-size: 14px; border: 1px solid #e5e7eb; border-radius: 12px; background-color: #f9fafb; outline: none;">
                <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #9ca3af; display: flex; align-items: center;">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 14px;"></i>
                </span>
            </div>

            <div class="text-xs text-gray-400 font-semibold">
                Total: <span class="text-gray-700 font-bold">{{ $proveedores->total() ?? $proveedores->count() }}</span> registrados
            </div>

        </div>
    </div>

    {{-- ============================================
         CAJA 3: TABLA DE PROVEEDORES
         ============================================ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="tablaProveedores">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">#</th>
                        <th class="py-3.5 px-6">Empresa / Razón Social</th>
                        <th class="py-3.5 px-6">NIT / RUC</th>
                        <th class="py-3.5 px-6">Contacto</th>
                        <th class="py-3.5 px-6">Teléfono</th>
                        <th class="py-3.5 px-6">Correo</th>
                        <th class="py-3.5 px-6 text-center">Estado</th>
                        <th class="py-3.5 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($proveedores as $prov)
                    <tr class="fila-proveedor hover:bg-gray-50/70 transition">
                        
                        {{-- ID --}}
                        <td class="py-4 px-6 text-xs text-gray-400 font-mono">
                            #{{ $prov->id }}
                        </td>

                        {{-- Nombre de la Empresa --}}
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-900 text-sm col-nombre">
                                {{ $prov->nombre }}
                            </div>
                            @if($prov->direccion)
                                <div class="text-[11px] text-gray-400 truncate max-w-xs" title="{{ $prov->direccion }}">
                                    <i class="fa-solid fa-location-dot text-[10px]"></i> {{ $prov->direccion }}
                                </div>
                            @endif
                        </td>

                        {{-- NIT / RUC --}}
                        <td class="py-4 px-6 font-mono text-xs text-gray-600 col-ruc">
                            {{ $prov->ruc ?: 'Sin registrar' }}
                        </td>

                        {{-- Contacto --}}
                        <td class="py-4 px-6 text-gray-700 col-contacto">
                            @if($prov->contacto)
                                <span class="inline-flex items-center gap-1.5 font-medium">
                                    <i class="fa-regular fa-user text-xs text-gray-400"></i> {{ $prov->contacto }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                        {{-- Teléfono --}}
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            @if($prov->telefono)
                                <a href="tel:{{ $prov->telefono }}" class="inline-flex items-center gap-1.5 text-gray-600 hover:text-[#00C897] transition">
                                    <i class="fa-solid fa-phone text-xs text-gray-400"></i> {{ $prov->telefono }}
                                </a>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                        {{-- Correo Electrónico --}}
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            @if($prov->email)
                                <a href="mailto:{{ $prov->email }}" class="inline-flex items-center gap-1.5 text-gray-600 hover:text-[#00C897] transition">
                                    <i class="fa-regular fa-envelope text-xs text-gray-400"></i> {{ $prov->email }}
                                </a>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                        {{-- Estado (Activo / Inactivo) --}}
                        <td class="py-4 px-6 text-center">
                            @if($prov->estado === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Activo
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Inactivo
                                </span>
                            @endif
                        </td>

                        {{-- Acciones (Editar y Eliminar) --}}
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                
                                {{-- Botón Editar --}}
                                <a href="{{ route('admin.proveedores.edit', $prov) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-700 transition"
                                   title="Editar Proveedor">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('admin.proveedores.destroy', $prov) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar a {{ addslashes($prov->nombre) }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 hover:bg-red-200 text-red-600 transition"
                                            title="Eliminar Proveedor">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-14 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fa-solid fa-truck-field text-4xl mb-3 text-gray-300"></i>
                                <p class="text-sm font-semibold text-gray-600">No hay proveedores registrados aún</p>
                                <p class="text-xs text-gray-400 mt-0.5">Empieza registrando a tus empresas proveedoras para gestionar compras</p>
                                <a href="{{ route('admin.proveedores.create') }}"
                                   class="mt-4 inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-xs font-bold py-2 px-4 rounded-xl transition shadow-sm">
                                    <i class="fa-solid fa-plus"></i> Registrar Primer Proveedor
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if($proveedores->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $proveedores->links() }}
            </div>
        @endif
    </div>

</div>

{{-- SCRIPT: BÚSQUEDA EN VIVO EN LA TABLA --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputBuscador = document.getElementById('buscadorProveedor');
        if (!inputBuscador) return;

        inputBuscador.addEventListener('keyup', function() {
            const termino = this.value.toLowerCase().trim();
            const filas = document.querySelectorAll('.fila-proveedor');

            filas.forEach(fila => {
                const nombre = fila.querySelector('.col-nombre')?.textContent.toLowerCase() || '';
                const ruc = fila.querySelector('.col-ruc')?.textContent.toLowerCase() || '';
                const contacto = fila.querySelector('.col-contacto')?.textContent.toLowerCase() || '';

                if (nombre.includes(termino) || ruc.includes(termino) || contacto.includes(termino)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection