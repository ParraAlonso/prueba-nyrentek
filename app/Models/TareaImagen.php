<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TareaImagen extends Model
{
    protected $table = 'tarea_imagenes';
    protected $fillable = [
        'tarea_id',
        'ruta_archivo',
        'url',
        'nombre_fotografo',
        'url_fotografo',
        'descripcion'
    ];

    public function tarea(){
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

}
