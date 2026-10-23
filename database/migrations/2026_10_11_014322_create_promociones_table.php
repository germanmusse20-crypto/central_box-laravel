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
    Schema::create('promociones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('producto_id')->constrained('productos');
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->decimal('descuento', 5, 2);
        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente');
        $table->foreignId('solicitado_por')->constrained('usuarios');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
