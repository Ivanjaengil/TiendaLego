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
        Schema::create('lego', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); 
            $table->string('nombre');
            $table->year('ano_publicacion');
            $table->integer('piezas');
            $table->integer('minifiguras');
            $table->string('imagen');
            $table->decimal('precio', 10, 2);
            $table->foreignId('idColeccion')->constrained('coleccion'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lego');
    }
};
