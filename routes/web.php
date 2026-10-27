<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Promocion;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\MetodoPagoController;

Route::get('/dashboard', function () {
    if (auth()->user()->rol === 'Admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard'); // Vista para clientes regulares
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUPO PANEL DE ADMINISTRACIÓN CENTRAL BOX
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 1. Inicio Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // 2. Usuarios
    Route::resource('usuarios', UsuarioController::class);
    // 3. Proveedores
    Route::resource('proveedores', ProveedorController::class);
    // 4. Categorías
    Route::resource('categorias', CategoriaController::class);
    // 5. Productos e Insumos
    Route::resource('productos', ProductoController::class);
    // 6. Gestión de Stock y Kardex
    Route::get('stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('stock/{producto}/ajustar', [StockController::class, 'ajustar'])->name('stock.ajustar');
    // 7 & 8. Ventas (Nueva venta online e Historial)
    Route::resource('ventas', VentaController::class)->only(['index', 'create', 'store', 'show']);
    // 9 & 10. Reportes y Resumen Ganancias
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    // 11. Métodos de Pago (solo visualizar y cambiar estado)
    Route::get('metodos-pago', [MetodoPagoController::class, 'index'])->name('metodos-pago.index');
    Route::post('metodos-pago/{metodo}/toggle', [MetodoPagoController::class, 'toggle'])->name('metodos-pago.toggle');

});

Route::get('/', function () {
    // Consultamos los productos activos (con su categoría para evitar consultas lentas)
    // Usamos try-catch por si la tabla aún no existe o no tiene datos
    try {
        $productos = Producto::with('categoria')->where('activo', true)->take(8)->get();
        $categorias = Categoria::withCount('productos')->take(4)->get();
        $promociones = Promocion::with('producto.categoria')->where('estado', 'aprobada')->take(3)->get();
    } catch (\Exception $e) {
        // Si hay algún problema con la BD, enviamos colecciones vacías
        $productos = collect();
        $categorias = collect();
        $promociones = collect();
    }
    return view('welcome', compact('productos', 'categorias', 'promociones'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
