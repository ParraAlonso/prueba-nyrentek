<?php

namespace App\Models\Catalogos;

use App\Models\Tarea;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = 'cat_estatus';
    protected $fillable = ['codigo','nombre'];

    public function tareas(){
        return $this->hasMany(Tarea::class,'estatus_id');
    }

}
