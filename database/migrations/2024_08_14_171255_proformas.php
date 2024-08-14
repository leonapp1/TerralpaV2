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
        Schema::create('proformas', function (Blueprint $table) {
            $table->id(); // ID column

            $table->unsignedBigInteger('idusuario'); // Foreign key or integer column
            $table->date('fechaInicial'); // Date column
            $table->date('fechav'); // Date column
            $table->string('departamento'); // Textual column
            $table->string('provincia'); // Textual column
            $table->string('distrito'); // Textual column
            $table->string('direccion'); // Textual column
            $table->string('estado'); // Textual column
            $table->decimal('subtotal', 10, 2); // Decimal column with precision
            $table->decimal('descuento', 10, 2); // Decimal column with precision
            $table->unsignedBigInteger('idcliente'); // Foreign key or integer column

            $table->timestamps(); // Created_at and Updated_at columns

            // Optional: Add indexes or foreign key constraints if needed
            // $table->foreign('idusuario')->references('id')->on('users');
            // $table->foreign('idcliente')->references('id')->on('clients');
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
