<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderBy('id', 'desc')->paginate(10);
        return view('admin.proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('admin.proveedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:255',
            'contacto'  => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
            'ruc'       => 'nullable|string|max:50',
            'estado'    => 'required|in:active,inactive',
        ]);

        Proveedor::create($data);
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function edit(Proveedor $proveedore) // Nota: Laravel infiere el nombre del parámetro
    {
        return view('admin.proveedores.edit', ['proveedor' => $proveedore]);
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:255',
            'contacto'  => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
            'ruc'       => 'nullable|string|max:50',
            'estado'    => 'required|in:active,inactive',
        ]);

        $proveedore->update($data);
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor eliminado.');
    }
}