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
            //$table->string('periodo_duracion');
            $table->string('archivo_convocatoria');
            $table->string('vigente')->default(0);
            //$table->unsignedBigInteger('id_estanciarequisitos'); // Cambiamos el nombre de la columna
            $table->timestamps();

            //$table->foreign('id_estanciarequisitos')->references('id')->on('estanciarequisitos');
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
