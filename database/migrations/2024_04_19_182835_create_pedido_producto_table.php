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
        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id');
            $table->foreignId('producto_id');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('pedido_id')
                ->references('id')->on('pedidos')
                ->onDelete('cascade');
            $table->foreign('producto_id')
                ->references('id')->on('productos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_producto');
        DB::statement("ALTER TABLE pedido_producto AUTO_INCREMENT = 1;");

        
    }
};
