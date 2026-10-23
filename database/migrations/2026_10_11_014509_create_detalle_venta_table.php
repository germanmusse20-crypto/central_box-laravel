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
    Schema::create('detalle_venta', function (Blueprint $table) {
        $table->id('id_detalle_venta');
        $table->foreignId('id_venta')->constrained('venta', 'id_venta');
        $table->foreignId('id_producto')->constrained('productos');
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 10, 2);   // precio sin IVA
        $table->decimal('descuento', 10, 2)->default(0);
        $table->decimal('iva', 5, 2)->default(19.00); // tarifa en %
        $table->decimal('subtotal', 10, 2);          // (precio_unitario × cantidad) − descuento
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
        Schema::dropIfExists('detalle_venta');
    }
};
