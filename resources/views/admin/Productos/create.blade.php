@extends('layouts.admin')

@section('titulo', 'Crear Producto - Central Box')

@section('contenido')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900">Nuevo Producto / Insumo</h2>
            <p class="text-xs text-gray-500">Diligencia la información para registrar el producto en el catálogo</p>
        </div>
        <a href="{{ route('admin.productos.index') }}" class="text-xs font-bold text-gray-600 hover:text-gray-900 flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> Volver al inventario
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nombre del Producto *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Cable HDMI 2m, Memoria USB 64GB..." required
                    class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Categoría -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Categoría *</label>
                <select name="categoria_id" required class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Precios & Impuestos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Precio Base (Sin IVA) *</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-2.5 text-gray-400 font-bold text-sm">$</span>
                        <input type="number" step="0.01" name="precio" value="{{ old('precio', 0) }}" required
                            class="w-full pl-8 rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm font-bold">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">IVA (%) *</label>
                    <input type="number" step="0.01" name="iva" value="{{ old('iva', 19.00) }}" required
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                </div>
            </div>

            <!-- Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Stock Inicial *</label>
                    <input type="number" name="stock" value="{{ old('stock', 10) }}" required
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Stock Mínimo (Alerta) *</label>
                    <input type="number" name="stock_minimo" value="{{ old('stock_minimo', 5) }}" required
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                </div>
            </div>

            <!-- Foto -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Fotografía del Producto</label>
                <input type="file" name="imagen" accept="image/*"
                    class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>

            <!-- Botones -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.productos.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">Cancelar</a>
                <button type="submit" class="bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-emerald-500/20">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>

</div>
@endsection