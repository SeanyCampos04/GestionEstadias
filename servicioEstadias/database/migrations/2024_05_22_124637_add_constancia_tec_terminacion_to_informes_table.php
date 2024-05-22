<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstanciaTecTerminacionToInformesTable extends Migration
{
    public function up()
    {
        Schema::table('informes', function (Blueprint $table) {
            $table->string('constancia_tec_terminacion')->nullable();
        });
    }

    public function down()
    {
        Schema::table('informes', function (Blueprint $table) {
            $table->dropColumn('constancia_tec_terminacion');
        });
    }
}
