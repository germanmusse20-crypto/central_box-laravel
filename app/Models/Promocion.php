<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';

    protected $fillable = [
        'producto_id', 'nombre', 'descripcion', 'descuento', 
        'fecha_inicio', 'fecha_fin', 'estado', 'solicitado_por'
    ];

    // Relación: La promoción pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}