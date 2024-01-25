@extends('layouts.base')

@section('content')

    <div class="container">
        <h3>Compendios</h3>
    </div>
    <div class="container d-flex flex-row justify-content-between ">
        <div class="d-flex flex-row">
            <a href="{{ route('compendio.index') }}" class="d-flex flex-row">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z" />
                </svg>
                <p class="mx-2">VER TODOS</p>
            </a>
        </div>


    </div>
        <div class="container">
            <div class="d-flex flex-row justify-content-between mb-2">
                <h3 class="mb-2">{{ $compendio->titulo }}</h3>

                @if($compendio->urlDocumento && pathinfo($compendio->urlDocumento, PATHINFO_EXTENSION) !== 'pdf')
                    <a href="{{ "../" . $compendio->urlDocumento }}" data-id="{{ $compendio->id }}" data-tipo="compendio" download>
                        <button id="btnDescargar" class="btn btn-sm btn-warning gothamB text-white rounded-pill btn-xxsm" >DESCARGAR</button>
                    </a>
                @elseif($compendio->urlLink)
                    <a href="{{$compendio->urlLink}}" target="_blank">
                        <button id="btnDescargar" class="btn btn-sm btn-warning gothamB text-white rounded-pill btn-xxsm" >IR A ENLACE</button>
                    </a>
                @endif

            </div>
            <hr>            
            @if($compendio->urlDocumento && pathinfo($compendio->urlDocumento, PATHINFO_EXTENSION) === 'pdf')
                <div class="d-flex flex-column align-items-center ">
                    <iframe src="{{ asset($compendio->urlDocumento) }}" frameborder="0" width="80%" height="900px"></iframe>
                </div>
            @elseif(!$compendio->urlLink && !$compendio->urlDocumento)
                <h3>No hay PDF</h3>
            @endif
            
        </div>

        <script src="{{ asset('assets/js/descargasHandler.js')}}" type="module"></script>  
    @endsection
