@extends('tareas.layout')
@section('breadcrumbs')
    <x-breadcrumbs :crumbs="[
        ['label' => 'Listado de tareas', 'url' => route('tareas.index')],
        ['label' => $tarea->titulo, 'url' => route('tareas.show',$tarea->id)],
        ['label' => 'Imágenes', 'url' => null],
    ]" />
@endsection
@section('content-tarea')
    @include('tareas.partials.carrusel-imagenes')
@endsection
