<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model {
    // Línea 6: Le decimos a Laravel el nombre exacto de la tabla en la BD
    protected $table = 'metodos_pago';

    // Línea 8: Los campos que se pueden asignar masivamente (Mass Assignment)
    protected $fillable = ['nombre', 'descripcion', 'estado'];

    // Línea 11-14: Relación → Un método de pago puede tener muchos pagos registrados
    // Esto nos permite saber cuántas veces se usó cada método
    public function pagos() {
        return $this->hasMany(Pago::class, 'id_metodo_pago');
    }
}
