<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsuariosExport;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:usuarios,email',
            'telefono' => 'nullable|string|max:20',
            'rol'      => 'required|in:admin,vendedor,cliente',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'rol'      => $request->rol,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario registrado con éxito.');
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id,
            'telefono' => 'nullable|string|max:20',
            'rol'      => 'required|in:admin,vendedor,cliente',
            'estado'   => 'required|in:active,inactive',
        ]);

        $usuario->update($request->only('nombre', 'email', 'telefono', 'rol', 'estado'));

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
    public function exportarExcel()
    {
        return Excel::download(new UsuariosExport, 'usuarios_central_box.xlsx');
    }
}