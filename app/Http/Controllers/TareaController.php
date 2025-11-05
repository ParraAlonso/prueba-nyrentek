<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncidenteRequest;
use App\Http\Requests\StoreTareaRequest;
use App\Models\Catalogos\Estatus;
use App\Models\Tarea;
use App\Services\TareaService;
use Illuminate\Support\Str;

class TareaController extends Controller
{
    protected $tareaService;

    public function __construct(TareaService $tareaService)
    {
        $this->tareaService = $tareaService;
    }

    public function index()
    {
        return view('tareas.index', ['tareas' => $this->tareaService->getTareas()]);
    }

    public function detalle(Tarea $tarea)
    {
        return view("tareas.detalle", compact('tarea'));
    }
    public function showOrCreate(Tarea $tarea = null, $seccion = 'informacion')
    {
        $catEstatus = [];
        if($seccion == 'informacion'){
            $catEstatus = Estatus::orderBy('nombre', 'asc')->get();
        }
        return view("tareas.$seccion", compact('tarea', 'seccion','catEstatus'));
    }

    public function store(Tarea $tarea = null, StoreTareaRequest $request)
    {
        return $this->tareaService->storeTarea($tarea, $request);
    }

    public function destroy(Tarea $tarea)
    {
        $this->tareaService->deleteTarea($tarea);
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente');
    }
}
