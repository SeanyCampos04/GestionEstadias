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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estancia');
            $table->string('email');
            $table->foreign('id_estancia')->references('id')->on('estancias')->onDelete('cascade');
            $table->json('requisitos');
            $table->integer('status');
            $table->string('docente')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('empresa')->nullable();
            $table->integer('status_convenio')->nullable();
            $table->string('periodo_duracion');
            $table->timestamps();

            $table->dropForeign(['id_estancia']);

            $table->foreign('id_estancia')->references('id')->on('estanciarequisitos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            // Eliminar la clave foránea agregada en el método up
            $table->dropForeign(['id_estancia']);

            // Volver a agregar la clave foránea anterior que apunta a la tabla estancias
            $table->foreign('id_estancia')->references('id')->on('estancias');
        });
        Schema::dropIfExists('solicitudes');
        
    }
};

