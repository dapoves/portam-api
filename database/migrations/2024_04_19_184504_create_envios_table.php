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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id');
            $table->foreignId('origen_id');
            $table->foreignId('destino_id');
            $table->double('precioTotal', 6, 2);
            $table->enum('tipo', ['ligero', 'pesado']);
            $table->string('peso');
            $table->enum('espera', ['Este mes', 'Esta semana', 'Hoy', 'Lo antes posible']);
            $table->text('indicaciones')->nullable();
            $table->foreignId('repartidor_id')->nullable();
            $table->foreignId('tarjeta_id')->nullable();
            $table->enum('estado', ['pendiente', 'aceptado', 'en camino', 'entregado', 'cancelado'])->default('pendiente');
            $table->dateTime('fechaPedido');
            $table->dateTime('fechaAceptado')->nullable();
            $table->dateTime('fechaEntrega')->nullable();
            $table->timestamps();
    
            $table->foreign('cliente_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
            $table->foreign('repartidor_id')
                ->references('id')->on('usuarios')
                ->onDelete('set null');
            $table->foreign('tarjeta_id')
                ->references('id')->on('tarjetas')
                ->onDelete('set null');
            $table->foreign('origen_id')
                ->references('id')->on('poblaciones');
            $table->foreign('destino_id')
                ->references('id')->on('poblaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};