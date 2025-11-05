@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <p class="text-muted">
                        <i>Los datos marcados con asterísco <span class="text-danger fw-bold">*</span> son obligatorios.</i>
                    </p>
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12 form-group">
                                <label for="name" class="form-label">Nombre (s)</label>
                                <input placeholder="Introduzca su(s) nombre(s)" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 form-group mt-2">
                                <label for="last_name" class="form-label">Primer apellido</label>
                                <input placeholder="Introduzca su primer apellido" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 form-group mt-2">
                                <label for="second_last_name" class="form-label">Segundo apellido</label>
                                <input placeholder="Introduzca su segundo apellido (opcional)" id="second_last_name" type="text" class="form-control @error('second_last_name') is-invalid @enderror" name="second_last_name" value="{{ old('second_last_name') }}" autocomplete="name" autofocus>
                                @error('second_last_name')
                                <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 form-group mt-2">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input placeholder="Introduzca su correo electrónico" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-2 text-end">
                                <button type="submit" class="btn btn-primary">
                                    Completar registro
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
