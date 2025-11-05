<?php

namespace App\Models;

use App\Models\Catalogos\Estatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use SoftDeletes;
    protected $table = 'tareas';
    protected $fillable = [
        'titulo',
        'descripcion',
        'estatus_id',
        'usuario_id'
    ];

    public function estatus(){
        return $this->belongsTo(Estatus::class,'estatus_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function imagenes(){
        return $this->hasMany(TareaImagen::class,'tarea_id');
    }
}
