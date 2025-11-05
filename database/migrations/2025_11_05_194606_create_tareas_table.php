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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->comment('Título de la tarea');
            $table->text('descripcion')->nullable()->comment('Descripción de la tarea');
            $table->unsignedBigInteger('estatus_id')->comment('FK del estatus de la tarea');
            $table->unsignedBigInteger('usuario_id')->comment('Usuario que registra/pertenece la tarea');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('estatus_id')->references('id')->on('cat_estatus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
