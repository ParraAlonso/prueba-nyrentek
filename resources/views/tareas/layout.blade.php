@extends('layouts.app')
@section('breadcrumbs')
    <x-breadcrumbs :crumbs="[
        ['label' => 'Listado de tareas', 'url' => route('tareas.index')],
        ['label' => $tarea ? $tarea->titulo : 'Nueva tarea', 'url' => null],
    ]" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="m-0 fw-semibold bg-{{@$tarea->estatus->codigo}} rounded p-2 px-3">
                    {{isset($tarea)?$tarea->titulo:'Nueva tarea'}}
                </h3>
            </div>
            @isset($tarea)
                <div class="col-md-6 text-end">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarTarea">Eliminar Tarea</button>
                </div>
            @endisset
            <div class="col-12 mt-3">
                <ul class="nav nav-tabs float-end border-0">
                    <li class="nav-item">
                        <a class="nav-link {{$seccion=='informacion' ? 'active' : ''}}" href="{{@$tarea->id?route('tareas.show',$tarea->id):route('tareas.create')}}">
                            Información
                        </a>
                    </li>
                    @isset($tarea)
                        <li class="nav-item">
                            <a class="nav-link {{$seccion=='imagenes' ? 'active' : ''}}" href="{{route('tareas.show',[$tarea->id,'imagenes'])}}">
                                Imágenes
                            </a>
                        </li>
                    @else
                        <li class="nav-item" data-bs-toggle="tooltip" title="Debe registrar la tarea para ver las imágenes.">
                            <a class="nav-link disabled">Imágenes</a>
                        </li>
                    @endisset
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-white rounded p-4">
                        @yield('content-tarea')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($tarea)
        @include('tareas.partials.modal_eliminar')
    @endisset
@endsection
