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
        Schema::create('cat_estatus', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique()->comment('Codigo/identificador del estatus');
            $table->string('nombre')->comment('Descripción del estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_estatus');
    }
};
