@extends('layouts.app')
@section('content')
    <div class="container mt-2">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0">Listado de tareas</h4>
            </div>
            @auth
                <div class="col-md-6 text-end">
                    <a href="{{route('tareas.create')}}" class="btn btn-primary">Nueva tarea</a>
                </div>
            @endauth
        </div>
        <div class="row">
            @forelse($tareas as $tarea)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body bg-white rounded">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="mb-1">
                                        <strong>Título:</strong> {{$tarea->titulo}}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Descripción:</strong> {{\Illuminate\Support\Str::limit($tarea->descripcion??'Sin información')}}
                                    </p>
                                    <p class="mb-1">
                                        <span class="badge p-1 bg-{{$tarea->estatus->codigo}}">{{$tarea->estatus->nombre}}</span>
                                    </p>
                                    <p class="mb-1 text-muted">
                                        {{$tarea->usuario->completeName}}
                                    </p>
                                </div>
                                <div class="col">
                                    <img src="{{asset('storage/'.$tarea->imagenes->first()->ruta_archivo)}}" class="img-thumbnail" >
                                </div>
                                <div class="col-12 mt-3 text-center">
                                    @auth
                                        <a href="{{route('tareas.show',$tarea->id)}}" class="btn btn-sm btn-primary">Editar tarea</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-secondary m-0 text-center">No existen tareas registradas actualmente.</div>
                        </div>
                    </div>
                </div>
            @endforelse
            <div class="col-12">
                {!! $tareas->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
