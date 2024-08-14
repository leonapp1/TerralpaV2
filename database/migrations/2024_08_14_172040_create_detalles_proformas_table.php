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
        Schema::create('detalles_proformas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo'); // Esto crea una columna 'codigo' de tipo string
            $table->text('descripcion'); // Esto crea una columna 'descripcion' de tipo text
            $table->decimal('cantidad_producto', 10, 2); // Esto crea una columna 'cantidad' de tipo integer
            $table->string('unidad_medida'); // Esto crea una columna 'codigo' de tipo string
            $table->string('equivale'); // Esto crea una columna 'codigo' de tipo string
            $table->decimal('precio_unitario', 10, 2); // Esto crea una columna 'peso' de tipo decimal, con 8 dígitos en total y 2 decimales
            $table->decimal('subtotal', 10, 2); // Esto crea una columna 'peso' de tipo decimal, con 8 dígitos en total y 2 decimales
            $table->decimal('peso', 10, 2); // Esto crea una columna 'peso' de tipo decimal, con 8 dígitos en total y 2 decimales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_proformas');
    }
};
