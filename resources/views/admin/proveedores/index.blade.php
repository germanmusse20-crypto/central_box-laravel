@extends('layouts.admin')

@section('titulo', 'Listado de Proveedores')

@section('content')
<div class="p-6">

    {{-- Encabezado --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: rgba(0,200,151,0.15);">
                <i class="fa-solid fa-truck-field text-xl" style="color: var(--cb-primary);"></i>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">Proveedores</h2>
                <p class="text-sm text-gray-500">Gestiona el listado de proveedores registrados</p>
            </div>
        </div>
        <a href="{{ route('admin.proveedores.create') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition hover:opacity-90 active:scale-95"
           style="background: var(--cb-primary);">
            <i class="fa-solid fa-plus"></i> Nuevo Proveedor
        </a>
    </div>

    {{-- Mensajes Flash --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 text-left">#</th>
                    <th class="px-6 py-4 text-left">Nombre / Empresa</th>
                    <th class="px-6 py-4 text-left">Contacto</th>
                    <th class="px-6 py-4 text-left">Telefono</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">RUC</th>
                    <th class="px-6 py-4 text-center">Estado</th>
                    <th class="px-6 py-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($proveedores as $proveedor)
                <tr class="hover:bg-gray-50/70 transition">
                    <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $proveedor->id }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $proveedor->nombre }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $proveedor->contacto ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $proveedor->telefono ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $proveedor->email ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600 font-mono text-xs">{{ $proveedor->ruc ?? '-' }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($proveedor->estado === 'active')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <i class="fa-solid fa-circle text-[8px]"></i> Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                                <i class="fa-solid fa-circle text-[8px]"></i> Inactivo
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.proveedores.edit', $proveedor) }}"
                               class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-100 flex items-center justify-center transition"
                               title="Editar">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.proveedores.destroy', $proveedor) }}"
                                  onsubmit="return confirm('Eliminar este proveedor?')" class="m-0">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 rounded-lg bg-red-50 text-red-400 hover:bg-red-100 flex items-center justify-center transition"
                                        title="Eliminar">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-16 text-center text-gray-400">
                        <i class="fa-solid fa-truck-field text-4xl mb-3 block opacity-30"></i>
                        <p class="font-semibold">No hay proveedores registrados</p>
                        <a href="{{ route('admin.proveedores.create') }}" class="text-sm mt-2 inline-block font-bold" style="color: var(--cb-primary);">
                            + Registrar el primer proveedor
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($proveedores->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $proveedores->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
