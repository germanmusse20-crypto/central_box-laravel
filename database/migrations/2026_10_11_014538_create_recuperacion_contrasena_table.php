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
    Schema::create('recuperacion_contrasena', function (Blueprint $table) {
        $table->id('id_recuperacion');
        $table->foreignId('id_usuario')->constrained('usuarios');
        $table->string('token')->unique();
        $table->dateTime('fecha_solicitud')->useCurrent();
        $table->dateTime('fecha_expiracion');
        $table->boolean('utilizada')->default(false);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recuperacion_contrasena');
    }
};
