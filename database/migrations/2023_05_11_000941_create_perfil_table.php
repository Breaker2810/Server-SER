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
        Schema::create('perfil', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false);
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idMultimedia');
            $table->foreign('idUsuario')->references('id')->on('usuario')->onDelete('cascade'); // en caso de ya no existir el usuario se elimina el perfil
            $table->foreign('idMultimedia')->references('id')->on('multimedia')->onUpdate('cascade'); // en caso de que se cambie la imagen del usario en multimedia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil');
    }
};
