<?php

// Línea 3: Declaramos el namespace (la "carpeta lógica" donde vive este controlador)
// OBLIGATORIO: debe coincidir exactamente con la carpeta física en app/Http/Controllers/Admin/
namespace App\Http\Controllers\Admin;

// Línea 8: Importamos el Controller base de Laravel (clase padre)
use App\Http\Controllers\Controller;

// Línea 11: Importamos el Modelo MetodoPago para poder usar la BD
use App\Models\MetodoPago;

// Línea 14: Importamos Request para recibir datos del formulario (lo necesitamos para toggle)
use Illuminate\Http\Request;

// Línea 17: Definimos la clase. NOTA: el nombre debe ser idéntico al nombre del archivo
class MetodoPagoController extends Controller
{
    // =========================================================
    // MÉTODO index() → Muestra el listado de métodos de pago
    // URL: GET /admin/metodos-pago
    // =========================================================
    public function index()
    {
        // Línea 25: Consultamos todos los métodos de pago de la BD
        // - withCount('pagos') → agrega una columna virtual "pagos_count"
        //   para saber cuántas veces se usó cada método (como productos_count en Categorias)
        // - orderBy('nombre') → los ordenamos alfabéticamente por nombre
        // - get() → ejecuta la consulta y devuelve una colección
        $metodos = MetodoPago::withCount('pagos')
                             ->orderBy('nombre')
                             ->get();

        // Línea 32: Enviamos la variable $metodos a la vista
        // La vista se ubicará en: resources/views/admin/MetodosPago/index.blade.php
        return view('admin.MetodosPago.index', compact('metodos'));
    }

    // =========================================================
    // MÉTODO toggle() → Habilita o Deshabilita un método de pago
    // URL: POST /admin/metodos-pago/{metodo}/toggle
    // =========================================================
    public function toggle(MetodoPago $metodo)
    {
        // Línea 41: Determinamos el nuevo estado (lógica de inversión):
        // - Si el estado actual es 'active'  → cambiamos a 'inactive'
        // - Si el estado actual es 'inactive' → cambiamos a 'active'
        // El operador ternario hace exactamente eso en una sola línea
        $nuevoEstado = $metodo->estado === 'active' ? 'inactive' : 'active';

        // Línea 46: Actualizamos SOLO el campo 'estado' en la BD
        // update() ejecuta un UPDATE de SQL directamente sobre ese registro
        $metodo->update(['estado' => $nuevoEstado]);

        // Línea 50: Preparamos el mensaje para mostrar al usuario
        // Si el nuevo estado es 'active' mostramos "habilitado", sino "deshabilitado"
        $mensaje = $nuevoEstado === 'active'
            ? "✅ Método '{$metodo->nombre}' habilitado correctamente."
            : "⛔ Método '{$metodo->nombre}' deshabilitado correctamente.";

        // Línea 56: Redireccionamos de vuelta al listado y enviamos el mensaje flash
        // with('success', ...) guarda el mensaje en la sesión para que admin.blade.php lo muestre
        return redirect()->route('admin.metodos-pago.index')->with('success', $mensaje);
    }
}