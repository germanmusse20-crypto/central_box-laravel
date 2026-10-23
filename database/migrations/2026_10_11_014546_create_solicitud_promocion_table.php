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
    Schema::create('solicitud_promocion', function (Blueprint $table) {
        $table->id('id_solicitud');
        $table->foreignId('id_empleado')->constrained('usuarios');
        $table->foreignId('id_promocion')->constrained('promociones');
        $table->string('nombre_propuesta');
        $table->string('descripcion')->nullable();
        $table->decimal('descuento_propuesto', 5, 2);
        $table->dateTime('fecha_solicitud')->useCurrent();
        $table->string('estado')->default('pendiente');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_promocion');
    }
};
