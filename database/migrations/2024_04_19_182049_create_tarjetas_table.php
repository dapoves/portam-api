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
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('numero');
            $table->enum('tipo', ['visa', 'mastercard', 'american_express']);
            $table->string('titular');
            $table->string('caducidad', 5);
            $table->string('cvv');
            $table->boolean('predeterminada')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjetas');
        DB::statement("ALTER TABLE tarjetas AUTO_INCREMENT = 1;");

    }
};
