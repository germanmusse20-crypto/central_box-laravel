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
                                        <button type="button"
                                            onclick="abrirModalEditarCategoria({{ $cat->id }}, '{{ addslashes($cat->nombre) }}', '{{ addslashes($cat->descripcion ?? '') }}', '{{ $cat->estado }}', '{{ $cat->imagen ? asset('storage/' . $cat->imagen) : '' }}')"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition cursor-pointer"
                                            title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
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
    {{-- ============================================
         ESTILOS DE ANIMACIÓN: DESDE ARRIBA HACIA EL CENTRO EN HD
         ============================================ --}}
    <style>
        @keyframes animarFondoHD {
            from { opacity: 0; backdrop-filter: blur(0px); }
            to { opacity: 1; backdrop-filter: blur(8px); }
        }

        /* Nace arriba transparente y desciende al centro en HD */
        @keyframes animarTarjetaArribaHD {
            0% {
                opacity: 0;
                transform: translateY(-130px) scale(0.92);
                filter: blur(8px);
            }
            60% {
                filter: blur(2px);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0px);
            }
        }

        #modalEditarCategoria.animar-hd {
            animation: animarFondoHD 350ms ease-out both;
        }

        #modalEditarCategoria.animar-hd > div {
            animation: animarTarjetaArribaHD 450ms cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @media (prefers-reduced-motion: reduce) {
            #modalEditarCategoria.animar-hd > div {
                animation: none !important;
            }
        }
    </style>

    {{-- ============================================
         MODAL: EDITAR CATEGORÍA
         ============================================ --}}
    <div id="modalEditarCategoria"
         class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
         role="dialog" aria-modal="true" aria-labelledby="modalEditarCategoriaTitulo">

        <div class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">

            {{-- Cabecera idéntica a tu diseño --}}
            <div class="flex items-start justify-between border-b border-slate-100 bg-gradient-to-r from-emerald-50 via-white to-white px-6 py-5 sm:px-8">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-[#00C897]">
                        <i class="fa-solid fa-pen-to-square text-xl"></i>
                    </div>
                    <div>
                        <h3 id="modalEditarCategoriaTitulo" class="text-2xl font-black text-gray-900">
                            Editar Categoría
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Actualiza los datos de la clasificación de productos.
                        </p>
                    </div>
                </div>

                <button type="button" onclick="cerrarModalEditarCategoria()"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                        title="Cerrar ventana">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            {{-- Formulario de Edición --}}
            <form id="formEditarCategoriaModal" method="POST" enctype="multipart/form-data" class="px-6 py-6 sm:px-8 space-y-5">
                @csrf
                @method('PUT')

                {{-- 1. Nombre de la Categoría --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Nombre de la Categoría *
                    </label>
                    <input type="text" id="editNombre" name="nombre" required
                           placeholder="Ej: TECNOLOGÍA, BEBIDAS..."
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100 font-medium">
                </div>

                {{-- 2. Descripción --}}
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Descripción (Opcional)
                    </label>
                    <textarea id="editDescripcion" name="descripcion" rows="3"
                              placeholder="Breve detalle sobre los artículos de esta categoría..."
                              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100 resize-none"></textarea>
                </div>

                {{-- 3. Estado y Cambiar Imagen --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Estado *
                        </label>
                        <select id="editEstado" name="estado" required
                                class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100 font-semibold">
                            <option value="active">🟢 Activo</option>
                            <option value="inactive">🔴 Inactivo</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Cambiar Imagen / Icono
                        </label>
                        <input type="file" name="imagen" accept="image/*"
                               class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                    </div>
                </div>

                {{-- Miniatura de imagen actual (se muestra dinámicamente si tiene) --}}
                <div id="contenedorPreviewImagen" class="hidden p-3 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-3">
                    <img id="imgPreviewActual" src="" alt="Imagen actual" class="w-12 h-12 rounded-lg object-cover border border-gray-200 shadow-xs">
                    <div>
                        <p class="text-xs font-bold text-gray-700">Imagen actual</p>
                        <p class="text-[11px] text-gray-400">Si subes un archivo nuevo arriba, este será reemplazado.</p>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                    <button type="button" onclick="cerrarModalEditarCategoria()"
                            class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="rounded-xl bg-[#00C897] hover:bg-[#009e77] px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-500/20 transition focus:outline-none focus:ring-4 focus:ring-emerald-100">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Actualizar Categoría
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
@push('scripts')
<script>
    function abrirModalEditarCategoria(id, nombre, descripcion, estado, urlImagen) {
        // 1. Asignamos la ruta con el ID exacto de la categoría
        document.getElementById('formEditarCategoriaModal').action = '/admin/categorias/' + id;

        // 2. Cargamos los datos en cada campo
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editDescripcion').value = descripcion;
        document.getElementById('editEstado').value = estado;

        // 3. Si tiene imagen actual, mostramos su miniatura
        const contenedorImg = document.getElementById('contenedorPreviewImagen');
        const tagImg = document.getElementById('imgPreviewActual');
        if (urlImagen && urlImagen.trim() !== '') {
            tagImg.src = urlImagen;
            contenedorImg.classList.remove('hidden');
        } else {
            contenedorImg.classList.add('hidden');
        }

        // 4. Mostramos el modal y disparamos la animación desde arriba
        const modal = document.getElementById('modalEditarCategoria');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        modal.classList.remove('animar-hd');
        void modal.offsetWidth; // Fuerza el reflow
        modal.classList.add('animar-hd');
    }

    function cerrarModalEditarCategoria() {
        const modal = document.getElementById('modalEditarCategoria');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.classList.remove('animar-hd');
    }

    // Cerrar con clic en el fondo oscuro exterior
    document.getElementById('modalEditarCategoria')?.addEventListener('click', function(e) {
        if (e.target === this) {
            cerrarModalEditarCategoria();
        }
    });

    // Cerrar con la tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModalEditarCategoria();
        }
    });
</script>
@endpush