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
        Schema::create('favoritos_establecimiento_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establecimiento_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('establecimiento_id')
                ->references('id')->on('establecimientos')
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
        Schema::dropIfExists('favoritos_establecimiento_user');
        DB::statement("ALTER TABLE favoritos_establecimiento_user AUTO_INCREMENT = 1;");
        
    }
};
