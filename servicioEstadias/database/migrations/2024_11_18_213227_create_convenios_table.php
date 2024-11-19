<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosTable extends Migration
{
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_vigencia');
            $table->string('archivo_convenio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('convenios');
    }
}
