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
        //
        Schema::table('compendios', function (Blueprint $table) {
            $table->unsignedInteger('tema')->nullable()->foreign('tema')->references('id')->on('temas');
            // Agrega más atributos según sea necesario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};