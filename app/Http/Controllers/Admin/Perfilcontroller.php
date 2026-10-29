<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    /**
     * Muestra la vista del perfil del administrador autenticado.
     */
    public function index()
    {
        $usuario = auth()->user();
        return view('admin.perfil.index', compact('usuario'));
    }

    /**
     * Actualiza los datos del perfil (nombre, correo, teléfono y dirección).
     */
    public function update(Request $request)
    {
        $usuario = auth()->user();

        // 1. Validamos los datos asegurando que el email sea único, excepto para el mismo usuario
        $data = $request->validate([
            'nombre'    => 'required|string|max:255',
            'email'     => ['required', 'email', 'max:255', Rule::unique('usuarios', 'email')->ignore($usuario->id)],
            'telefono'  => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:255',
        ], [
            'nombre.required' => 'El nombre completo es obligatorio.',
            'email.required'  => 'El correo electrónico es obligatorio.',
            'email.unique'    => 'Este correo electrónico ya está registrado por otro usuario.',
        ]);

        // 2. Actualizamos en la base de datos
        $usuario->update($data);

        // 3. Retornamos con mensaje de confirmación
        return redirect()->route('admin.perfil.index')
                         ->with('success', '¡Tus datos de perfil han sido actualizados con éxito!');
    }
}