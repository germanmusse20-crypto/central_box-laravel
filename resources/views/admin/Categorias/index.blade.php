@extends('layouts.admin')

@section('titulo', 'Categorías - Central Box')

@section('contenido')
<div class="space-y-6">

    <!-- CABECERA DEL MÓDULO -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-tags text-[#00C897]"></i> Catálogo & Clasificación
            </div>
            <h2 class="text-2xl font-black text-gray-900">Categorías de Productos</h2>
            <p class="text-xs text-gray-500 mt-0.5">Organiza las líneas de producto de Central Box (Bebidas, Tecnología, Ropa, Papelería)</p>
        </div>
        <a href="{{ route('admin.categorias.create') }}" class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-4 rounded-xl transition shadow-md shadow-emerald-500/20">
            <i class="fa-solid fa-plus"></i> Nueva Categoría
        </a>
    </div>

    <!-- TABLA DE CATEGORÍAS -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/70 text-gray-700 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6">ID</th>
                        <th class="py-4 px-6">Imagen</th>
                        <th class="py-4 px-6">Nombre de la Categoría</th>
                        <th class="py-4 px-6">Descripción</th>
                        <th class="py-4 px-6 text-center">Productos Asociados</th>
                        <th class="py-4 px-6 text-center">Estado</th>
                        <th class="py-4 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categorias as $cat)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-6 font-bold text-gray-900">#{{ $cat->id }}</td>
                            <td class="py-4 px-6">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden flex items-center justify-center text-gray-400">
                                    @if($cat->imagen)
                                        <img src="{{ asset('storage/' . $cat->imagen) }}" alt="{{ $cat->nombre }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-tag text-lg text-emerald-500"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6 font-bold text-gray-800">{{ $cat->nombre }}</td>
                            <td class="py-4 px-6 text-gray-500 text-xs max-w-xs truncate">{{ $cat->descripcion ?? 'Sin descripción' }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
                                    {{ $cat->productos_count ?? 0 }} ítems
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($cat->estado === 'active')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">Activo</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.categorias.edit', $cat->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.categorias.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400">No hay categorías registradas en la base de datos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categorias->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $categorias->links() }}
            </div>
        @endif
    </div>

</div>
@endsection