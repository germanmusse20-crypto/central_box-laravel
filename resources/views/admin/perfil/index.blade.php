@extends('layouts.admin')

@section('titulo', 'Mi Perfil - Central Box')

@section('contenido')
<div class="w-full space-y-6 max-w-5xl mx-auto">

    {{-- ============================================
         CABECERA DEL PERFIL
         ============================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center flex-shrink-0 text-2xl font-black text-[#00C897]">
                {{ strtoupper(substr($usuario->nombre ?? 'A', 0, 1)) }}
            </div>
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $usuario->rol }}
                    </span>
                    <span>• Central Box</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">{{ $usuario->nombre }}</h2>
                <p class="text-xs text-gray-500 mt-0.5">Administra tus datos personales y credenciales de contacto</p>
            </div>
        </div>

        <div class="text-xs text-gray-400 font-medium">
            Miembro desde: <span class="font-bold text-gray-700">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'Reciente' }}</span>
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
         FORMULARIO DE EDICIÓN DEL PERFIL
         ============================================ --}}
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm w-full">
        
        <div class="border-b border-gray-100 pb-4 mb-6">
            <h3 class="text-lg font-bold text-gray-800">Información Personal y de Contacto</h3>
            <p class="text-xs text-gray-500 mt-0.5">Modifica los campos que desees actualizar y guarda los cambios</p>
        </div>

        <form action="{{ route('admin.perfil.update') }}" method="POST" autocomplete="off" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Fila 1: Nombre Completo y Correo Electrónico --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Nombre --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Nombre Completo <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required
                               placeholder="Ej: Germán Musse"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('nombre') border-red-400 @enderror">
                    </div>
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Correo Electrónico --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Correo Electrónico <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                               placeholder="admin@centralbox.com"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('email') border-red-400 @enderror">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Fila 2: Teléfono / WhatsApp y Dirección --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Teléfono / Celular --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Teléfono / Celular
                    </label>
                    <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                           placeholder="Ej: +57 301 361 9644"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('telefono') border-red-400 @enderror">
                    @error('telefono')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dirección --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Dirección de Residencia o Despacho
                    </label>
                    <input type="text" name="direccion" value="{{ old('direccion', $usuario->direccion) }}"
                           placeholder="Ej: Calle 123 #45-67, Bogotá"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('direccion') border-red-400 @enderror">
                    @error('direccion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Botones de Acción al pie --}}
            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                <div class="text-xs text-gray-400">
                    <i class="fa-solid fa-shield-halved text-[#00C897]"></i> Tus datos están protegidos por Central Box
                </div>
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-emerald-500/20 active:scale-95">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </div>

        </form>

    </div>

</div>
@endsection