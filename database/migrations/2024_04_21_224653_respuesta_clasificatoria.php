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
        Schema::create('respuesta_clasificatoria', function (Blueprint $table) {
            $table->id();
            $table->string('Texto');
            $table->boolean('Valor');
            $table->unsignedBigInteger('pregunta_clasificatoria_id');
            $table->foreign('pregunta_clasificatoria_id','pregunta_foreign')->references('id')->on('pregunta_clasificatoria')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuesta_clasificatoria');
    }
};
