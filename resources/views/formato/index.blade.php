@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'FORMATOS')

    <div class="container mt-4">

        <div class="row">

            @forelse ( $formatos as $formato)
            
            <?php
                $_src = $formato->urlImagenThumb;
                if (strpos($formato->urlDocumento, '.xlsx') !== false) {
                    $_src = asset('assets/img/Formato-XLSX.png');
                }
                if (strpos($formato->urlDocumento, '.docx') !== false) {
                    $_src = asset('assets/img/Formato-DOCX.png');
                }
                if (strpos($formato->urlDocumento, '.pptx') !== false) {
                    $_src = asset('assets/img/Formato-PPTX.png');
                }
            ?>


            <div class="col-lg-2 col-md-4 mb-4 cardEffect">
                <div class="card align-items-center border-0 bg-transparent" style="width: 100%;">
                    <a href="{{ route('formato.show', $formato) }}">
                        <!-- <img src="{{ $formato->urlImagenThumb }}" class="img-formato" alt="Formato img" width="100px" height="150px"> -->
                        <img src="{{ $_src }}" class="img-formato" alt="Formato img" width="100px" height="150px">
                    </a>
                    <ul class="list-group list-group-flush align-items-center gothamB pt-1">
                        <li class="list-group-item d-flex flex-col align-items-center justify-content-center bg-transparent">
                            <p class="titulo-formato">{{ $formato->titulo }}</p>
                            <a href="{{ $formato->urlDocumento }}" data-id="{{ $formato->id }}" data-tipo="formato" download>
                                <button id="btnDescargar" type="button"
                                class="btn btn-warning text-morado hover:text-white btn-block btn-sm rounded-pill px-3">DESCARGAR</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
                
            @empty
                <h4>NINGÚN FORMATO POR MOSTRAR</h4>
            @endforelse
            @section('pagination')
            {{ $formatos->links('pagination::simple-bootstrap-5') }}
        @endsection
        </div>
    </div>
    <script src="{{ asset('assets/js/descargasHandler.js')}}" type="module"></script>  
    @endsection