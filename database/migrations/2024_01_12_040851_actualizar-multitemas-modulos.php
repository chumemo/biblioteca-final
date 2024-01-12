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
        // Manuales
        Schema::table('manuals', function (Blueprint $table) {
            $table->string('temas')->nullable();
        });

        // Folletos
        Schema::table('folletos', function (Blueprint $table) {
            $table->string('temas')->nullable();
        });

        // Formatos
        Schema::table('formatos', function (Blueprint $table) {
            $table->string('temas')->nullable();
        });

        // cataoogos
        Schema::table('catalogos', function (Blueprint $table) {
            $table->string('temas')->nullable();
        });
        
        //  Documentos
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('temas')->nullable();
        });

        // Capsulas
        Schema::table('capsulas', function (Blueprint $table) {
            $table->string('temas')->nullable();
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
