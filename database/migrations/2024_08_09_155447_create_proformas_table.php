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
            $table->id();
            $table->unsignedBigInteger('idusuario'); // Columna para referencia al usuario
            $table->date('fechaInicial'); // Columna 'fechaInicial' de tipo date
            $table->date('fechav'); // Columna 'fechav' de tipo date
            $table->string('departamento'); // Columna 'departamento' de tipo string
            $table->string('provincia'); // Columna 'provincia' de tipo string
            $table->string('distrito'); // Columna 'distrito' de tipo string
            $table->string('direccion'); // Columna 'direccion' de tipo string
            $table->string('estado'); // Columna 'estado' de tipo string
            $table->decimal('pagos', 10, 2); // Columna 'pagos' de tipo decimal con 10 dígitos en total y 2 decimales
            $table->decimal('subtotal', 10, 2); // Columna 'subtotal' de tipo decimal con 10 dígitos en total y 2 decimales
            $table->decimal('descuento', 10, 2); // Columna 'descuento' de tipo decimal con 10 dígitos en total y 2 decimales
            $table->unsignedBigInteger('idcliente'); // Columna para referencia al cliente

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proformas');
    }
};
