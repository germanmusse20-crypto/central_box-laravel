@extends('layouts.admin')

@section('titulo', 'Editar Usuario')

@section('contenido')
<div class="w-full space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900">Editar Usuario</h2>
            <p class="text-sm text-gray-500">
                Actualiza los datos y el acceso de {{ $usuario->nombre }}
            </p>
        </div>

        <a href="{{ route('admin.usuarios.index') }}"
           class="text-sm font-semibold text-gray-600 hover:text-gray-900">
            Volver al listado
        </a>
    </div>

    <div class="w-full bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <form action="{{ route('admin.usuarios.update', $usuario) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Nombre completo *
                </label>
                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $usuario->nombre) }}"
                       required
                       class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">

                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Correo electrónico *
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $usuario->email) }}"
                           required
                           class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Teléfono
                    </label>
                    <input type="text"
                           name="telefono"
                           value="{{ old('telefono', $usuario->telefono) }}"
                           class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">

                    @error('telefono')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Rol de acceso *
                    </label>
                    <select name="rol"
                            required
                            class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                        <option value="cliente" {{ old('rol', $usuario->rol) === 'cliente' ? 'selected' : '' }}>
                            Cliente
                        </option>
                        <option value="vendedor" {{ old('rol', $usuario->rol) === 'vendedor' ? 'selected' : '' }}>
                            Vendedor
                        </option>
                        <option value="admin" {{ old('rol', $usuario->rol) === 'Admin' ? 'selected' : '' }}>
                            Administrador
                        </option>
                    </select>

                    @error('rol')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Estado *
                    </label>
                    <select name="estado"
                            required
                            class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                        <option value="active" {{ old('estado', $usuario->estado ?? 'active') === 'active' ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="inactive" {{ old('estado', $usuario->estado ?? 'active') === 'inactive' ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>

                    @error('estado')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.usuarios.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900">
                    Cancelar
                </a>

                <button type="submit"
                        class="bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition">
                    Guardar cambios
                </button>
            </div>

        </form>
    </div>
</div>
@endsection