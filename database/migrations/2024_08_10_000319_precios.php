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
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 10, 2); // Columna 'precio' de tipo decimal con 10 dígitos en total y 2 decimales
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');

            $table->foreignId('lugar_id')->constrained('lugares')->onDelete('cascade');
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
