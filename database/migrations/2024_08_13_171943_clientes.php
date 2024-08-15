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
        Schema::create('Clientes', function (Blueprint $table) {
            $table->id(); // Crea una columna de ID auto-incremental
            $table->integer('dni'); 
            $table->text('nombre'); 
            $table->integer('telefono'); 

            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at'
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
