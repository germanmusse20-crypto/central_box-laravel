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
    Schema::create('venta', function (Blueprint $table) {
        $table->id('id_venta');
        $table->foreignId('id_cliente')->constrained('usuarios');
        $table->foreignId('id_usuario')->constrained('usuarios');
        $table->foreignId('id_pago')->constrained('pago', 'id_pago');
        $table->dateTime('fecha')->useCurrent();
        $table->decimal('subtotal', 10, 2);      // base sin IVA
        $table->decimal('descuento', 10, 2)->default(0);
        $table->decimal('iva', 5, 2)->default(19.00); // tarifa en %
        $table->decimal('iva_monto', 10, 2);     // IVA calculado
        $table->decimal('total', 10, 2);         // subtotal - descuento + iva_monto
        $table->string('estado')->default('pendiente');
        $table->string('tipo_venta');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
