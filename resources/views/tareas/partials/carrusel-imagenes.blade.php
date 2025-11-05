<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($tarea->imagenes as $k=>$imagen)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$k}}"
                    @if($loop->first) class="active" @endif
                    aria-current="true" aria-label="Slide {{$loop->iteration}}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($tarea->imagenes as $k=>$imagen)
            <div class="carousel-item @if($loop->first) active @endif">
                <img src="{{asset('storage/'.$imagen->ruta_archivo)}}" class="d-block w-100" alt="{{$imagen->descripcion}}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$imagen->nombre_fotografo}}</h5>
                    <a href="{{$imagen->url_fotografo}}">{{$imagen->url_fotografo}}</a>
                    <p>{{$imagen->descripcion}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>
