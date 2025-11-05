@extends('tareas.layout')
@section('content-tarea')
    <p>
        <i>Los datos marcados con asterísco <span class="text-danger fw-bold">*</span> son obligatorios.</i>
    </p>
    <form action="{{route('tareas.store',@$tarea->id)}}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            <h6 class="fw-semibold mb-1">Información general de la tarea</h6>

            <div class="col-md-6 form-group">
                <label for="titulo_tarea" class="form-label">Título</label>
                <input id="titulo_tarea" name="titulo" type="text" class="form-control form-control-sm @error('titulo') is-invalid @enderror"
                       placeholder="Título de la tarea" maxlength="255"
                       value="{{old('titulo',@$tarea->titulo)}}"
                       required
                >

                @error('titulo')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label for="estatus_tarea" class="form-label">Estatus:</label>
                <select name="estatus_id" id="estatus_tarea" class="form-select form-select-sm @error('estatus_id') is-invalid @enderror" required>
                    <option value="">Seleccione</option>
                    @foreach($catEstatus as $i)
                        <option value="{{$i->id}}" {{old('estatus_id',@$tarea->estatus_id)==$i->id?'selected':''}}>
                            {{$i->nombre}}
                        </option>
                    @endforeach
                </select>
                @error('estatus_id')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="col-md-12 form-group">
                <label for="descripcion_tarea" class="form-label">Descripción</label>
                <textarea rows="4" id="descripcion_tarea" name="descripcion" type="text"
                          class="form-control form-control-sm @error('objeto') is-invalid @enderror"
                          placeholder="Descripción de la tarea">{{old('descripcion',@$tarea->descripcion)}}</textarea>
                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="col-12 mt-3 text-end">
                <a href="{{route('tareas.index')}}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    {{isset($tarea)?'Actualizar tarea':'Registrar tarea'}}
                </button>
            </div>
        </div>
    </form>
@endsection
