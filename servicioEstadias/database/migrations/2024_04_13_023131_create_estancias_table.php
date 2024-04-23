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
        Schema::create('estancias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha_convocatoria');
            $table->date('fecha_cierre');
            $table->string('periodo_duracion');
            $table->string('archivo_convocatoria');
            $table->string('vigente')->default(0);
            $table->unsignedBigInteger('id_estancia_requisitos'); // Agregamos la columna de la clave foránea
            $table->timestamps();

            $table->foreign('id_estancia_requisitos')->references('id')->on('estancia_requisitos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estancias');
    }
};
