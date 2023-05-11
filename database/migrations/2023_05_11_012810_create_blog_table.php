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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable(false); // titulo del blog
            $table->unsignedInteger('idUsuario')->nullable(false); // el autor
            $table->string('descripcion')->nullable(false); // la descripcion del articulo
            $table->text('conteido')->nullable(false); // el contenido infiinito, expera... XD
            $table->json('imagenes')->nullable(); // aqui se almacenaran todas las id's
            $table->foreign('idUsuario')->references('id')->on('usuario')->onDelete('cascade'); // en caso de eliminar el empleado este se desaparece y 
            $table->timestamps(); // cuando se creo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
