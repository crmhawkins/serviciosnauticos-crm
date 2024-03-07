<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_entradas_transeuntes', function (Blueprint $table) {
            $table->double('precio')->nullable();
            $table->double('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registros_entradas_transeuntes', function (Blueprint $table) {
            $table->dropColumn('precio');
            $table->dropColumn('total');
        });
    }
};
