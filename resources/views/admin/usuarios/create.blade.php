@extends('layouts.admin')

@section('titulo', 'Registrar Usuario - Central Box')

@section('contenido')
<div class="w-full space-y-6">

    <!-- CABECERA -->
    <div class="flex items-center justify-between">
        <div class="text-left">
            <h2 class="text-2xl font-bold text-gray-900">Registrar nuevo usuario</h2>
            <p class="text-1xl text-gray-500 w-full">Crea las credenciales de acceso para tus clientes y vendedores de central_box</p>
        </div>
        <a href="{{ route('admin.usuarios.index') }}" class="text-white font-bold text-gray-600 hover:text-gray-900 flex items-center gap-1">
            <button type="submit" class="bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-emerald-500/20">
            <i class="fa-solid fa-arrow-left"></i> Volver al listado
        </a>
    </div>

    <!-- FORMULARIO -->
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm w-full">
        <form action="{{ route('admin.usuarios.store') }}" method="POST" autocomplete="off" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nombre Completo *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Juan Pérez" required
                    class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email y Teléfono -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Correo Electrónico *</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="usuario@correo.com" required autocomplete="off"
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="3001234567"
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                    @error('telefono') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Rol -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Rol de Acceso *</label>
                <select name="rol" required class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm font-semibold">
                    <option value="">Seleccione el rol de acceso</option>
                    <option value="cliente" {{ old('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="vendedor" {{ old('rol') == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                </select>
                @error('rol') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Contraseñas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Contraseña *</label>
                    <input type="password" name="password" required placeholder="Mínimo 8 caracteres"
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Confirmar Contraseña *</label>
                    <input type="password" name="password_confirmation" required placeholder="Repetir contraseña"
                        class="w-full rounded-xl border-gray-200 focus:border-[#00C897] focus:ring-[#00C897] text-sm">
                </div>
            </div>

            <!-- Botones -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.usuarios.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">Cancelar</a>
                <button type="submit" class="bg-[#00C897] hover:bg-[#009e77] text-white text-sm font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-emerald-500/20">
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>

</div>
@endsection