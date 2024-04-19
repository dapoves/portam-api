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
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->foreignId('poblacion_id');
            $table->string('direccion');
            $table->string('imagen');
            $table->foreignId('categoria_id');
            $table->integer('tiempoPreparacion');
            $table->double('costeEnvio', 5, 2);
            $table->bigInteger('likes')->default(0);

            $table->foreign('categoria_id')
            ->references('id')->on('categorias');
            $table->foreign('poblacion_id')
            ->references('id')->on('poblaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establecimientos');
    }
};
