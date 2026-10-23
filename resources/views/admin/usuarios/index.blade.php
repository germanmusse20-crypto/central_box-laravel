@extends('layouts.admin')

@section('titulo', 'Gestión de Usuarios')
@section('encabezado', 'Listado de Usuarios Registrados')

@section('contenido')
<div class="space-y-6">

    {{-- ============================================
         CAJA 1: CABECERA (título + botón)
         ============================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-users text-[#00C897]"></i> Administración de Personal
            </div>
            <h2 class="text-2xl font-black text-gray-900">Listado de Usuarios</h2>
            <p class="text-xs text-gray-500 mt-0.5">Administra los roles y accesos del personal y clientes</p>
        </div>
        <a href="{{ route('admin.usuarios.create') }}" class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-4 rounded-xl transition shadow-md shadow-emerald-500/20">
            <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
        </a>
    </div>
    {{-- FIN CAJA 1 --}}

    {{-- ============================================
     CAJA 2: BUSCADOR + MOSTRAR + EXCEL + PDF
     ============================================ --}}
    <div class="bg-white px-6 py-4 rounded-2xl border border-gray-100 shadow-sm">
    <div class="flex flex-wrap items-center justify-between gap-4">

        {{-- Buscador lado izquierdo --}}
        <div class="relative flex-1">
            <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </span>
            <input type="text" id="buscadorUsuario" placeholder="Buscar usuario..."
                class="w-full pl-4 pr-9 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50">
        </div>

        {{-- Controles lado derecho --}}
            <label class="text-sm text-gray-600 font-medium">Mostrar</>
            <select class="border border-gray-200 rounded-lg text-sm focus:outline-none  focus:ring-[#00C897]/40">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <button class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded-lg transition">
                <i class="fa-solid fa-file-excel"></i> Excel
            </button>
            <button class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-3 rounded-lg transition">
                <i class="fa-solid fa-file-pdf"></i> PDF
            </button>
        </div>

    </div>
    {{-- FIN CAJA 2 --}}

    {{-- ============================================
         CAJA 3: LA TABLA DE USUARIOS
         ============================================ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">

                {{-- ENCABEZADOS DE LA TABLA --}}
                <thead class="bg-gray-50/70 text-gray-700 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6">ID <i class="fa-solid fa-sort text-gray-400 ml-1"></i></th>
                        <th class="py-4 px-6">Nombre <i class="fa-solid fa-sort text-gray-400 ml-1"></i></th>
                        <th class="py-4 px-6">Email <i class="fa-solid fa-sort text-gray-400 ml-1"></i></th>
                        <th class="py-4 px-6">Rol <i class="fa-solid fa-sort text-gray-400 ml-1"></i></th>
                        <th class="py-4 px-6">Estado <i class="fa-solid fa-sort text-gray-400 ml-1"></i></th>
                        <th class="py-4 px-6 text-center">Editar</th>
                        <th class="py-4 px-6 text-center">Eliminar</th>
                    </tr>
                </thead>

                {{-- FILAS DE DATOS --}}
                <tbody class="divide-y divide-gray-100">
                    @forelse($usuarios as $usr)
                        <tr class="hover:bg-gray-50/50 transition">

                            {{-- Columna ID --}}
                            <td class="py-4 px-6 font-bold text-gray-900">{{ $usr->id }}</td>

                            {{-- Columna Nombre --}}
                            <td class="py-4 px-6 font-medium text-gray-800">{{ $usr->nombre }}</td>

                            {{-- Columna Email --}}
                            <td class="py-4 px-6">{{ $usr->email }}</td>

                            {{-- Columna Rol --}}
                            <td class="py-4 px-6">
                                @if($usr->rol === 'admin')
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-700">admin</span>
                                @elseif($usr->rol === 'vendedor')
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700">vendedor</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-purple-100 text-purple-700">cliente</span>
                                @endif
                            </td>

                            {{-- Columna Estado --}}
                            <td class="py-4 px-6">
                                @if($usr->estado === 'active')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">Activo</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">Inactivo</span>
                                @endif
                            </td>

                            {{-- Columna Editar --}}
                            <td class="py-4 px-6 text-center">
                            <button
                                onclick="abrirModalEditar({{ $usr->id }}, '{{ $usr->nombre }}', '{{ $usr->email }}', '{{ $usr->telefono ?? '' }}', '{{ $usr->rol }}', '{{ $usr->estado }}')"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-600 transition" title="Editar">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </button>
                        </td>


                            {{-- Columna Eliminar --}}
                            <td class="py-4 px-6 text-center">
                                @if($usr->id !== auth()->id())
                                    <form action="{{ route('admin.usuarios.destroy', $usr->id) }}" method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 hover:bg-red-200 text-red-500 transition" title="Eliminar">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed" title="No puedes eliminar tu propia cuenta">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                    </span>

                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-400">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if($usuarios->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $usuarios->links() }}
            </div>
        @endif

    </div>
    {{-- FIN CAJA 3 --}}

</div>
{{-- ============================================
     MODAL EDITAR USUARIO
     ============================================ --}}
<div id="modalEditar" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">

        {{-- Cabecera del modal --}}
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">
                <i class="fa-solid fa-user-pen text-[#00C897] mr-2"></i> Editar Usuario
            </h3>
            <button onclick="cerrarModalEditar()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        {{-- Formulario --}}
        <form id="formEditar" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" id="editNombre" name="nombre" required
                    class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" id="editEmail" name="email" required
                    class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50">
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                <input type="text" id="editTelefono" name="telefono"
                    class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50">
            </div>

            {{-- Rol --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Rol</label>
                <select id="editRol" name="rol" required
                    class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50">
                    <option value="admin">Admin</option>
                    <option value="vendedor">Vendedor</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>

            {{-- Estado --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
                <select id="editEstado" name="estado" required
                    class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50">
                    <option value="active">Activo</option>
                    <option value="inactive">Inactivo</option>
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="cerrarModalEditar()"
                    class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-bold text-white bg-[#00C897] hover:bg-[#009e77] rounded-xl transition">
                    Guardar Cambios
                </button>
            </div>
        </form>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('buscadorUsuario').addEventListener('keyup', function() {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('tbody tr');
        filas.forEach(function(fila) {
            const texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(filtro) ? '' : 'none';
        });
    });
    function abrirModalEditar(id, nombre, email, telefono, rol, estado) {
    // 1. Construimos la URL de envío con el ID del usuario
    document.getElementById('formEditar').action = '/admin/usuarios/' + id;

    // 2. Llenamos cada campo del formulario con los datos del usuario
    document.getElementById('editNombre').value   = nombre;
    document.getElementById('editEmail').value    = email;
    document.getElementById('editTelefono').value = telefono;
    document.getElementById('editRol').value      = rol;
    document.getElementById('editEstado').value   = estado;

    // 3. Mostramos el modal
    const modal = document.getElementById('modalEditar');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function cerrarModalEditar() {
    // Ocultamos el modal
    const modal = document.getElementById('modalEditar');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Cerrar el modal si el usuario hace clic fuera del cuadro blanco
document.getElementById('modalEditar').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalEditar();
    }
});

</script>
@endpush