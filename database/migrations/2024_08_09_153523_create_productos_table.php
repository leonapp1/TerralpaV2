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
            $table->id(); // Esto crea una columna 'id' que será la clave primaria
            $table->string('codigo'); // Esto crea una columna 'codigo' de tipo string
            $table->text('descripcion'); // Esto crea una columna 'descripcion' de tipo text
            $table->string('Unid'); // Esto crea una columna 'Unid' de tipo integer
            $table->decimal('peso', 8, 2); // Esto crea una columna 'peso' de tipo decimal, con 8 dígitos en total y 2 decimales
            $table->integer('cantidad'); // Esto crea una columna 'cantidad' de tipo integer
            $table->string('img')->nullable(); // Esto crea una columna 'img' de tipo string y permite valores nulos
            $table->timestamps(); // Esto crea las columnas 'created_at' y 'updated_at'
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
