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
        Schema::create('favoritos_establecimiento_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establecimiento_id');
            $table->foreignId('usuario_id');
            $table->timestamps();

            $table->foreign('establecimiento_id')
                ->references('id')->on('establecimientos')
                ->onDelete('cascade');

            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos_establecimiento_usuario');
        
    }
};
