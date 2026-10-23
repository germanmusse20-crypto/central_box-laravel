@extends('layouts.admin')

@section('titulo', 'Gestión de Usuarios')
@section('encabezado', 'Listado de Usuarios Registrados')

@section('contenido')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="font-bold text-gray-800 text-lg">Usuarios de Central Box</h3>
            <p class="text-xs text-gray-500">Administra los roles y accesos del personal y clientes</p>
        </div>
        <a href="{{ route('admin.usuarios.create') }}" class="inline-flex items-center gap-2 bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-4 rounded-lg transition shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                <tr>
                    <th class="py-3.5 px-6">ID</th>
                    <th class="py-3.5 px-6">Nombre</th>
                    <th class="py-3.5 px-6">Email</th>
                    <th class="py-3.5 px-6">Teléfono</th>
                    <th class="py-3.5 px-6">Rol</th>
                    <th class="py-3.5 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($usuarios as $usr)
                    <tr class="hover:bg-gray-50/80 transition">
                        <td class="py-4 px-6 font-semibold text-gray-900">#{{ $usr->id }}</td>
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $usr->nombre }}</td>
                        <td class="py-4 px-6">{{ $usr->email }}</td>
                        <td class="py-4 px-6">{{ $usr->telefono ?? 'N/A' }}</td>
                        <td class="py-4 px-6">
                            @if($usr->rol === 'admin')
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">Administrador</span>
                            @elseif($usr->rol === 'vendedor')
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700">Vendedor</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-700">Cliente</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center flex items-center justify-center gap-2">
                            <a href="{{ route('admin.usuarios.edit', $usr->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            @if($usr->id !== auth()->id())
                                <form action="{{ route('admin.usuarios.destroy', $usr->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-400">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($usuarios->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $usuarios->links() }}
        </div>
    @endif
</div>
@endsection