<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class CatalogoController extends Controller
{
    public function porCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        $productos = Producto::where('categoria_id', $id)
                             ->where('activo', true)
                             ->get();

        return view('catalogo', compact('categoria', 'productos'));
    }
}