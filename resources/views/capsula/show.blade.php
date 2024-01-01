@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'CÁPSULA INFORMATIVA')

    <div class="container mt-4">
        
        <h2 class="gothamB text-secondary m-2 " > {{ $capsula->titulo }}</h2>
        <hr>
        <p class="fs-6 m-2 mb-2 text-secondary " > {!! $capsula->descripcion !!}</p>
    
        <div>
            <iframe width="100%" height="480px"
                id="videoIframe"
                src="{{ $capsula->url }}" title=" {{ $capsula->titulo }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

    </div>

@endsection
