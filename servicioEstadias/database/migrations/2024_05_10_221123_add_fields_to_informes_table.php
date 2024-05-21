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
        Schema::table('informes', function (Blueprint $table) {
            $table->string('ruta_constancia')->nullable()->after('nombre');
            $table->string('ruta_oficio')->nullable()->after('ruta_constancia');
            $table->dropColumn('ruta_archivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informes', function (Blueprint $table) {
            $table->string('ruta_archivo')->nullable()->after('nombre');
            $table->dropColumn('ruta_constancia');
            $table->dropColumn('ruta_oficio');
        });
    }
};
