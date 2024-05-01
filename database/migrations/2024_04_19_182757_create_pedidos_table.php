<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


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
            $table->double('precioTotal', 6, 2);
            $table->text('indicaciones')->nullable();
            $table->foreignId('repartidor_id')->nullable();
            $table->foreignId('tarjeta_id')->nullable();
            $table->enum('estado', ['pendiente', 'aceptado', 'en camino', 'entregado', 'cancelado'])->default('pendiente');
            $table->dateTime('fechaPedido');
            $table->dateTime('fechaAceptado')->nullable();
            $table->dateTime('fechaEntrega')->nullable();
            $table->timestamps();
    
            $table->foreign('cliente_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('establecimiento_id')
                ->references('id')->on('establecimientos');
            $table->foreign('repartidor_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('tarjeta_id')
                ->references('id')->on('tarjetas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
        DB::statement("ALTER TABLE pedidos AUTO_INCREMENT = 1;");

    }
};
