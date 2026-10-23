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
    Schema::create('pedidos_proveedor', function (Blueprint $table) {
        $table->id();
        $table->foreignId('proveedor_id')->constrained('proveedores');
        $table->foreignId('usuario_id')->constrained('usuarios');
        $table->string('codigo')->unique();
        $table->enum('estado', ['pendiente', 'aprobado', 'recibido', 'cancelado'])->default('pendiente');
        $table->decimal('total', 10, 2);
        $table->string('motivo_cancel')->nullable();
        $table->text('notas')->nullable();
        $table->date('fecha_entrega')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_proveedor');
    }
};
