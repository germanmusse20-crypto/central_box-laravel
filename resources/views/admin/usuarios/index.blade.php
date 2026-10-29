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
        <div class="relative flex-1" style="position: relative; flex: 1;">
            <input type="text" id="buscadorUsuario" placeholder="Buscar usuario..."
                class="w-full pl-4 pr-10 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00C897]/40 bg-gray-50 text-gray-800"
                style="width: 100%; padding-left: 16px; padding-right: 42px; padding-top: 10px; padding-bottom: 10px; font-size: 14px; border: 1px solid #e5e7eb; border-radius: 12px; background-color: #f9fafb; outline: none;">
            <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #9ca3af; display: flex; align-items: center;">
                <i class="fa-solid fa-magnifying-glass" style="font-size: 14px;"></i>
            </span>
        </div>

        {{-- Controles lado derecho --}}
            <label class="text-sm text-gray-600 font-medium">Mostrar</>
            <select class="border border-gray-200 rounded-lg text-sm focus:outline-none  focus:ring-[#00C897]/40">
                <option>5</option>
                <option>10</option>
                <option>15</option>
            </select>
            {{-- Botón Excel --}}
            <a href="{{ route('admin.usuarios.exportar-excel') }}"
               class="inline-flex items-center gap-2 text-white text-xs font-bold py-2 px-4 rounded-lg transition"
               style="background-color: #16a34a;">
                <i class="fa-solid fa-file-excel fa-lg"></i> Excel
            </a>

            {{-- Botón PDF --}}
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
                        <th class="py-4 px-6">ID</th>
                        <th class="py-4 px-6">Nombre</i></th>
                        <th class="py-4 px-6">Email</th>
                        <th class="py-4 px-6">Telefono</th>
                        <th class="py-4 px-6">Rol</th>
                        <th class="py-4 px-6">Estado</th>
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

                            {{-- Columna Telefono --}}
                            <td class="py-4 px-6">{{ $usr->telefono ?? 'N/A' }}</td>

                            {{-- Columna Rol --}}
                            <td class="py-4 px-6">
                                @if($usr->rol === 'Admin')
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

<style>
    /* Animación suave del fondo */
    @keyframes modalEditarFondo {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Animación de entrada de la ventana */
    @keyframes modalEditarTarjeta {
        from {
            opacity: 0;
            transform: translateY(14px) scale(0.97);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Fondo del modal */
    #modalEditar.animar-entrada {
        animation: modalEditarFondo 220ms ease-out both;
    }

    /* Cuadro blanco del modal */
    #modalEditar.animar-entrada > div {
        animation: modalEditarTarjeta 260ms
            cubic-bezier(0.2, 0.8, 0.2, 1) both;
            
    }

    /* Respetar a quienes prefieren menos movimiento */
    @media (prefers-reduced-motion: reduce) {
        #modalEditar.animar-entrada,
        #modalEditar.animar-entrada > div {
            animation: none !important;
        }
    }
</style>

{{-- MODAL EDITAR USUARIO --}}
<div id="modalEditar"
    class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
    role="dialog" aria-modal="true" aria-labelledby="modalEditarTitulo">

    <div class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">

        {{-- Cabecera --}}
        <div class="flex items-start justify-between border-b border-slate-100 bg-gradient-to-r from-emerald-50 via-white to-white px-6 py-5 sm:px-8">

            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                    <i class="fa-solid fa-user-pen text-xl"></i>
                </div>

                <div>
                    <h3 id="modalEditarTitulo" class="text-xl font-bold tracking-tight text-slate-900">
                        Editar usuario
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Actualiza la información de la cuenta.
                    </p>
                </div>
            </div>

            <button type="button"
                onclick="cerrarModalEditar()"
                aria-label="Cerrar ventana"
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        {{-- Formulario --}}
        <form id="formEditar" method="POST" class="px-6 py-6 sm:px-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- Nombre --}}
                <div>
                    <label for="editNombre" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nombre completo
                    </label>
                    <input type="text" id="editNombre" name="nombre" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                </div>

                {{-- Correo --}}
                <div>
                    <label for="editEmail" class="mb-2 block text-sm font-semibold text-slate-700">
                        Correo electrónico
                    </label>
                    <input type="email" id="editEmail" name="email" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                </div>

                {{-- Teléfono --}}
                <div>
                    <label for="editTelefono" class="mb-2 block text-sm font-semibold text-slate-700">
                        Teléfono
                    </label>
                    <input type="text" id="editTelefono" name="telefono"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                </div>

                {{-- Rol --}}
                <div>
                    <label for="editRol" class="mb-2 block text-sm font-semibold text-slate-700">
                        Rol del usuario
                    </label>
                    <select id="editRol" name="rol" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                        <option value="Admin">Admin</option>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Cliente">Cliente</option>
                    </select>
                </div>

                {{-- Estado --}}
                <div class="sm:col-span-2">
                    <label for="editEstado" class="mb-2 block text-sm font-semibold text-slate-700">
                        Estado de la cuenta
                    </label>
                    <select id="editEstado" name="estado" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00C897] focus:ring-4 focus:ring-emerald-100">
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                    </select>
                    <p class="mt-2 text-xs text-slate-500">
                        Selecciona si la cuenta puede permanecer activa o debe quedar inactiva.
                    </p>
                </div>
            </div>

            {{-- Botones --}}
            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

                <button type="button" onclick="cerrarModalEditar()"
                    class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Cancelar
                </button>

                <button type="submit"
                    class="rounded-xl bg-[#00C897] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#009e77] focus:outline-none focus:ring-4 focus:ring-emerald-100">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Guardar cambios
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
    document.getElementById('formEditar').action = '/Admin/usuarios/' + id;

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
    // Reiniciar la animación para que funcione en cada apertura
    modal.classList.remove('animar-entrada');
    void modal.offsetWidth;
    modal.classList.add('animar-entrada');
}

// Cerrar el modal si el usuario hace clic fuera del cuadro blanco
document.getElementById('modalEditar').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalEditar();
    }
});

</script>
@endpush