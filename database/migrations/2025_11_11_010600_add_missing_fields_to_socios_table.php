<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('socios', function (Blueprint $table) {
            if (!Schema::hasColumn('socios', 'alta_baja')) {
                $table->boolean('alta_baja')->default(0)->after('pin_socio');
            }
            if (!Schema::hasColumn('socios', 'fecha_baja')) {
                $table->date('fecha_baja')->nullable()->after('alta_baja');
            }
            if (!Schema::hasColumn('socios', 'ruta_foto2')) {
                $table->string('ruta_foto2')->nullable()->after('ruta_foto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('socios', function (Blueprint $table) {
            if (Schema::hasColumn('socios', 'fecha_baja')) {
                $table->dropColumn('fecha_baja');
            }
            if (Schema::hasColumn('socios', 'alta_baja')) {
                $table->dropColumn('alta_baja');
            }
            if (Schema::hasColumn('socios', 'ruta_foto2')) {
                $table->dropColumn('ruta_foto2');
            }
        });
    }
};



