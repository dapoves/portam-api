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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('imagen');
            $table->double('precio', 6, 2);
            $table->foreignId('establecimiento_id');
            $table->enum('tamano', ['pequeno', 'mediano', 'grande']);
            $table->bigInteger('likes')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('establecimiento_id')
                ->references('id')->on('establecimientos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
        DB::statement("ALTER TABLE productos AUTO_INCREMENT = 1;");
    }
};
