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
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('urlImagen')->nullable();
            $table->string('urlDocumento')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha')->nullable();
            $table->unsignedInteger('estado')->default(1);
            $table->unsignedInteger('autorId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos');
    }
};
