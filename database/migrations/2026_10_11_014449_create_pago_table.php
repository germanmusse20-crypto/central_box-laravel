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
    Schema::create('pago', function (Blueprint $table) {
        $table->id('id_pago');
        $table->foreignId('id_metodo_pago')->constrained('metodos_pago');
        $table->decimal('monto', 10, 2);
        $table->dateTime('fecha_pago')->useCurrent();
        $table->string('estado')->default('pendiente');
        $table->string('referencia')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago');
    }
};
