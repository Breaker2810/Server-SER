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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable(false); // Nombre del archivo
            $table->string('descripcion')->nullable(false); // Descripcion
            $table->integer('tipo')->nullable(false); // Tipo de archivo (1 = imagen | 2 = video)
            $table->string('url')->nullable(false); // url donde se encuentra el archivo
            $table->string('formato'); // indica el formato del archivo (para cosas de organizacion de aksrchivos o algo asi, es decir [mp4, jpg, png, etc])
            $table->boolean("isPerfil")->nullable(false); // indica si pertenece al avatar de algun perfil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};
