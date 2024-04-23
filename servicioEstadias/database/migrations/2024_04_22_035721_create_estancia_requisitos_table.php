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
        Schema::create('estancia_requisitos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estancia');
            $table->unsignedBigInteger('id_requisito');
            $table->timestamps();
            $table->foreign('id_estancia')->references('id')->on('estancias')->onDelete('cascade');
            $table->foreign('id_requisito')->references('id')->on('requisitos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estancia_requisitos');
    }
};
