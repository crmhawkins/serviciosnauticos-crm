<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barco_fotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->string('ruta');
            $table->boolean('destacada')->default(false);
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();

            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
            $table->index(['socio_id', 'destacada']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barco_fotos');
    }
};


