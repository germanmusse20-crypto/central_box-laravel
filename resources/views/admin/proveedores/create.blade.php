@extends('layouts.admin')
@section('titulo', 'Registrar Proveedor - Central Box')
@section('contenido')
<div class="w-full space-y-6">
    {{-- ============================================
         CABECERA: TÍTULO + ÍCONO + BOTÓN VOLVER
         ============================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-2">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-truck-moving text-[#00C897] text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Registrar nuevo proveedor</h2>
                <p class="text-sm text-gray-500 mt-0.5">Ingresa los datos comerciales de tus aliados y distribuidores para Central Box</p>
            </div>
        </div>
        {{-- Botón para regresar al listado --}}
        <a href="{{ route('admin.proveedores.index') }}"
           class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 text-sm font-semibold py-2.5 px-5 rounded-xl transition shadow-sm">
            <i class="fa-solid fa-arrow-left text-xs"></i> Volver al listado
        </a>
    </div>
    {{-- ============================================
         ALERTA DE ERRORES DE VALIDACIÓN
         ============================================ --}}
    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
            <p class="font-bold flex items-center gap-2 mb-1">
                <i class="fa-solid fa-circle-exclamation"></i> Por favor corrige los siguientes campos:
            </p>
            <ul class="list-disc list-inside ml-2 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- ============================================
         FORMULARIO PRINCIPAL
         ============================================ --}}
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm w-full">
        <form action="{{ route('admin.proveedores.store') }}" method="POST" autocomplete="off" class="space-y-6">
            @csrf
            {{-- Fila 1: Nombre de la Empresa y RUC / NIT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Nombre de la Empresa / Razón Social <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                           placeholder="Ej: Distribuidora Nacional S.A.S."
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('nombre') border-red-400 @enderror">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        NIT / RUC / Cédula Fiscal
                    </label>
                    <input type="text" name="ruc" value="{{ old('ruc') }}"
                           placeholder="Ej: 900.123.456-7"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('ruc') border-red-400 @enderror">
                    @error('ruc')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Fila 2: Persona de Contacto y Teléfono --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Persona de Contacto / Asesor
                    </label>
                    <input type="text" name="contacto" value="{{ old('contacto') }}"
                           placeholder="Ej: Carlos Gómez (Ventas)"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('contacto') border-red-400 @enderror">
                    @error('contacto')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Teléfono / Celular
                    </label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                           placeholder="Ej: +57 310 987 6543"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('telefono') border-red-400 @enderror">
                    @error('telefono')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Fila 3: Correo Electrónico y Estado --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Correo Electrónico
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="ventas@proveedor.com"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Estado en Plataforma <span class="text-red-500">*</span>
                    </label>
                    <select name="estado" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-white">
                        <option value="active" {{ old('estado', 'active') === 'active' ? 'selected' : '' }}>
                            🟢 Activo (Disponible para compras)
                        </option>
                        <option value="inactive" {{ old('estado') === 'inactive' ? 'selected' : '' }}>
                            🔴 Inactivo (Pausado temporalmente)
                        </option>
                    </select>
                    @error('estado')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Fila 4: Dirección Física / Bodega --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Dirección de la Bodega o Despacho
                </label>
                <textarea name="direccion" rows="3"
                          placeholder="Ej: Zona Industrial Calle 15 # 40-20, Bodega 4, Bogotá"
                          class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 focus:border-[#00C897] transition bg-gray-50/50 resize-none @error('direccion') border-red-400 @enderror">{{ old('direccion') }}</textarea>
                @error('direccion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- Botones de Acción al pie --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.proveedores.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:text-gray-800 text-sm font-semibold transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-emerald-500/20 active:scale-95">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Proveedor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection