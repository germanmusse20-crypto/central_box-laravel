<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $timestamps = false; // Tu migración usa columna 'fecha' por defecto

    protected $fillable = [
        'id_cliente',
        'id_usuario',
        'id_pago',
        'fecha',
        'subtotal',
        'descuento',
        'iva',
        'iva_monto',
        'total',
        'estado',
        'tipo_venta',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id_venta');
    }
}