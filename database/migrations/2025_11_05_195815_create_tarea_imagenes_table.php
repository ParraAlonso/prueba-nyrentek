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
        Schema::create('tarea_imagenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarea_id')->comment('ID de Imagen');
            $table->string('ruta_archivo')->comment('Ruta del archivo de la imagen');
            $table->string('url')->comment('URL de la imagen');
            $table->string('nombre_fotografo')->comment('Nombre del fotografo de la imagen');
            $table->string('url_fotografo')->comment('URL del fotografo');
            $table->text('descripcion')->nullable()->comment('Descripcion de la imagen');
            $table->timestamps();

            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_imagenes');
    }
};
