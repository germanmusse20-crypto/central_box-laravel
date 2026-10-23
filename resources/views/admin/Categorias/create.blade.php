@extends('layouts.admin')

@section('titulo', 'Crear Categoría - Central Box')

@section('contenido')
<div class="max-w-2xl mx-auto space-y-6">

    <!-- ENCABEZADO -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900">Nueva Categoría</h2>
            <p class="text-xs text-gray-500">Crea una clasificación para agrupar los productos de la tienda</p>
        </div>
        <a href="{{ route('admin.categorias.index') }}" class="text-xs font-bold text-gray-600 hover:text-gray-900 flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> Volver al listado
        </a>
    </div>

    <!-- FORMULARIO -->
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nombre de la Categoría *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: TECNOLOGÍA, BEBIDAS, ROPA..." required
                    class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Descripción (Opcional)</label>
                <textarea name="descripcion" rows="3" placeholder="Breve detalle sobre los artículos de esta categoría..."
                    class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">{{ old('descripcion') }}</textarea>
                @error('descripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Estado -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Estado *</label>
                    <select name="estado" class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                        <option value="active" {{ old('estado') == 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="inactive" {{ old('estado') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <!-- Imagen -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Icono / Imagen</label>
                    <input type="file" name="imagen" accept="image/*"
                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>

            <!-- Botones -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categorias.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">Cancelar</a>
                <button type="submit" class="bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-emerald-500/20">
                    Guardar Categoría
                </button>
            </div>
        </form>
    </div>

</div>
@endsection