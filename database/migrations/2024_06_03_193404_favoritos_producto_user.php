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
        Schema::create('favoritos_producto_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('producto_id')
                ->references('id')->on('productos')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos_producto_user');
        DB::statement("ALTER TABLE favoritos_producto_user AUTO_INCREMENT = 1;");

    }
};
