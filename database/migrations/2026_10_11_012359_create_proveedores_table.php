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
    Schema::create('proveedores', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');                    // nombre o razón social
        $table->string('contacto')->nullable();      // persona de contacto
        $table->string('telefono')->nullable();
        $table->string('email')->nullable();
        $table->text('direccion')->nullable();
        $table->string('ruc')->nullable();           // o NIT, RFC, según tu país
        $table->enum('estado', ['active', 'inactive'])->default('active');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
