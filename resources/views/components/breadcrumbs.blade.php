@if (!empty($crumbs))
    <div class="col-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($crumbs as $crumb)
                    @if ($loop->last || empty($crumb['url']))
                        <li class=" text-secondary fw-semibold" aria-current="page" @if(strlen($crumb['label'])>75) data-bs-toggle="tooltip" title="{{$crumb['label']}}" @endif>{{ mb_strimwidth($crumb['label'],0,75,'...') }}</li>
                    @else
                        <li class="" @if(strlen($crumb['label'])>75) data-bs-toggle="tooltip" title="{{$crumb['label']}}" @endif><a class="btn-link text-secondary" href="{{ $crumb['url'] }}">{{ mb_strimwidth($crumb['label'],0,75,'...') }}</a><span class="mx-1">-</span></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
@endif
