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
    Schema::create('carrito', function (Blueprint $table) {
        $table->id('id_carrito');
        $table->foreignId('id_cliente')->constrained('usuarios');
        $table->dateTime('fecha_creacion')->useCurrent();
        $table->string('estado')->default('activo');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
