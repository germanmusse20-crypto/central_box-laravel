<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model {
    protected $table = 'pago';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;
    protected $fillable = ['id_metodo_pago', 'monto', 'fecha_pago', 'estado', 'referencia'];

    public function metodo() {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago');
    }
}