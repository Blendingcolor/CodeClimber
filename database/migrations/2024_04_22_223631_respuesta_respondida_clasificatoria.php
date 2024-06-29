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
        Schema::create('respuesta_respondida_clasificatoria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clasificatorio_usuario_id');
            $table->foreign('clasificatorio_usuario_id', 'clasifi_usu_foreign')->references('id')->on('clasificatorio_usuario')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pregunta_clasificatoria_id');
            $table->foreign('pregunta_clasificatoria_id', 'pregun_clasi_foreign')->references('id')->on('pregunta_clasificatoria')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('respuesta_clasificatoria_id');
            $table->foreign('respuesta_clasificatoria_id', 'respue_clasi_foreign')->references('id')->on('respuesta_clasificatoria')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'userid_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('Correcta');
            $table->integer('Puntajeobtenido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuesta_respondida_clasificatoria');
    }
};
