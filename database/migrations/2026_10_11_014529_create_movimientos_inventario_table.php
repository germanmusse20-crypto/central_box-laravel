<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('movimientos_inventario', function (Blueprint $table) {
        $table->id();
        $table->foreignId('producto_id')->constrained('productos');
        $table->foreignId('usuario_id')->constrained('usuarios');
        $table->enum('tipo', ['entrada', 'salida', 'ajuste'])->default('ajuste');
        $table->integer('cantidad');
        $table->integer('stock_anterior');
        $table->integer('stock_nuevo');
        $table->string('motivo')->nullable();
        $table->timestamp('created_at')->useCurrent();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_inventario');
    }
};
