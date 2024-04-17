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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id');
            $table->foreignId('establecimiento_id');
            $table->foreignId('repartidor_id')->nullable();
            $table->enum('estado', ['pendiente', 'aceptado', 'en camino', 'entregado', 'cancelado'])->default('pendiente');
            $table->dateTime('fechaPedido');
            $table->dateTime('fechaAceptado')->nullable();
            $table->dateTime('fechaEntrega')->nullable();
            $table->double('precioTotal', 6, 2);
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->foreign('establecimiento_id')
                ->references('id')->on('establecimientos');
            $table->foreign('repartidor_id')
                ->references('id')->on('usuarios')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
