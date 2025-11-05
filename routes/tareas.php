<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::prefix('tareas')->name('tareas.')->group(function () {
    Route::get('/', [TareaController::class, 'index'])->name('index');
    //Validación de sesión para rutas
    Route::middleware(['auth'])->group(function () {
        Route::get('create', [TareaController::class, 'showOrCreate'])->name('create');
        Route::get('{tarea}/{seccion?}', [TareaController::class, 'showOrCreate'])->name('show');
        Route::post('store/{tarea?}', [TareaController::class, 'store'])->name('store');
        Route::delete('{tarea}/destroy', [TareaController::class, 'destroy'])->name('destroy');
    });
});
