<div id="alerts_container">
    {{-- success --}}
    @if(session()->has('success') && session('success')!='')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> {!! session('success') !!}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- error --}}
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</strong> {!! session('error') !!}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- warning --}}
    @if(session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Advertencia:</strong> {!! session('warning') !!}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- info --}}
    @if(session()->has('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Información:</strong> {!! session('info') !!}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
