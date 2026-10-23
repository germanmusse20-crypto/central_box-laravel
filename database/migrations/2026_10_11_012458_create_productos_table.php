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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->decimal('precio', 10, 2);          // precio sin IVA
        $table->decimal('iva', 5, 2)->default(19.00); // tarifa en %
        $table->integer('stock')->default(0);
        $table->integer('stock_minimo')->default(0);
        $table->string('imagen')->nullable();
        $table->foreignId('categoria_id')->constrained('categorias');
        $table->foreignId('vendedor_id')->nullable()->constrained('usuarios');
        $table->boolean('activo')->default(true);
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
