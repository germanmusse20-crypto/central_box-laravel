<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'iva', 'stock', 
        'stock_minimo', 'imagen', 'categoria_id', 'vendedor_id', 'activo'
    ];

    // Relación: Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relación: Un producto puede tener promociones
    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'producto_id');
    }
}