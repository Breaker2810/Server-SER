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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre')->nullable(false);
            $table->string('apellido_pat')->nullable(false);
            $table->string('apellido_mat')->nullable(false); 
            $table->integer('puesto')->nullable(false);
            $table->string('correo')->unique()->nullable(false);
            $table->string('contraseña')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
