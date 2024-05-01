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
        Schema::create('poblaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('codigoPostal');
            $table->foreignId('zona_id');
            $table->timestamps();

            $table->foreign('zona_id')
                ->references('id')->on('zonas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poblaciones');
        DB::statement("ALTER TABLE poblaciones AUTO_INCREMENT = 1;");
    }
};
