@extends('layouts.admin')

@section('titulo', 'Registrar Proveedor')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    {{-- Encabezado --}}
    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: rgba(0,200,151,0.15);">
            <i class="fa-solid fa-truck-plus text-xl" style="color: var(--cb-primary);"></i>
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-gray-800">Registrar Proveedor</h2>
            <p class="text-sm text-gray-500">Completa los datos del nuevo proveedor</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm space-y-1">
            <p class="font-bold flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i> Corrige los siguientes errores:</p>
            <ul class="list-disc list-inside ml-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.proveedores.store') }}"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">
                    Nombre de la Empresa / Proveedor <span class="text-red-400">*</span>
                </label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       placeholder="Ej: Distribuidora ABC S.A."
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('nombre') border-red-400 @enderror">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Persona de Contacto</label>
                <input type="text" name="contacto" value="{{ old('contacto') }}"
                       placeholder="Ej: Juan Perez"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Telefono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}"
                       placeholder="Ej: +51 999 888 777"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Correo Electronico</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="proveedor@empresa.com"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">RUC / NIT</label>
                <input type="text" name="ruc" value="{{ old('ruc') }}"
                       placeholder="Ej: 20123456789"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Direccion</label>
                <textarea name="direccion" rows="2"
                          placeholder="Av. Principal 123, Lima, Peru"
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition resize-none">{{ old('direccion') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Estado <span class="text-red-400">*</span></label>
                <select name="estado"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition bg-white">
                    <option value="active"   {{ old('estado', 'active') === 'active'   ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ old('estado') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.proveedores.index') }}"
               class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition">
                <i class="fa-solid fa-arrow-left text-xs"></i> Volver al listado
            </a>
            <button type="submit"
                    class="flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white transition hover:opacity-90 active:scale-95"
                    style="background: var(--cb-primary);">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Proveedor
            </button>
        </div>

    </form>
</div>
@endsection
