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
    Schema::create('detalle_pedido_proveedor', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pedido_id')->constrained('pedidos_proveedor');
        $table->foreignId('producto_id')->constrained('productos');
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 10, 2);   // precio sin IVA
        $table->decimal('iva', 5, 2)->default(19.00); // tarifa en %
        $table->decimal('subtotal', 10, 2);          // precio_unitario × cantidad
        $table->decimal('iva_monto', 10, 2);         // subtotal × (iva / 100)
        $table->decimal('total_linea', 10, 2);       // subtotal + iva_monto
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido_proveedor');
    }
};
