@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-md-center" id="loginRow">
            <div class="col-md-7 text-center mb-3">
                <small id="loadingTitle">Cargando imágenes...</small>
                <div id="carouselExample" class="carousel slide d-none">
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <p class="text-muted">
                            <i>Los datos marcados con asterísco <span class="text-danger fw-bold">*</span> son obligatorios.</i>
                        </p>
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="email" class="form-label">
                                        {{ __('Email Address') }}
                                    </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Introduzca su correo">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 form-group mt-2">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Introduzca su contraseña">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 mt-2 text-start">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="col-12 text-center">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-12 text-center">
                                        ¿No tiene una cuenta?
                                        <a class="btn btn-link" href="{{ route('register') }}">
                                            Regístrese aquí
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3 text-center">
                <a href="{{route('tareas.index')}}" class="btn btn-outline-primary">Listado de tareas registradas</a>
            </div>
        </div>
    </div>
@endsection
