@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'CATÁLOGOS')

    <div class="container mt-4">

        <div class="row">

            @forelse ( $catalogos as $catalogo)

            <?php
                $_src = $catalogo->urlImagen;
                if (strpos($catalogo->urlDocumento, '.xlsx') !== false) {
                    $_src = asset('assets/img/Formato-XLSX.png');
                }
                if (strpos($catalogo->urlDocumento, '.docx') !== false) {
                    $_src = asset('assets/img/Formato-DOCX.png');
                }
                if (strpos($catalogo->urlDocumento, '.pptx') !== false) {
                    $_src = asset('assets/img/Formato-PPTX.png');
                }
                
            ?>

            <div class="col-lg-2 col-md-4 mb-2 cardEffect">
                <div class="card align-items-center border-0 bg-transparent" style="width: 100%;">
                    <!-- <p class="text-secondary">{{ $catalogo->titulo }}</p> -->
                    
                    <!-- <img src="{{ $catalogo->urlImagen }}" class="img-catalogo" alt="catalogo img"> -->

                    <img src="{{ $_src }}" class="img-catalogo" alt="catalogo img">
                    <h6 class=" text-secondary mt-2 text-center titulo-catalogo"> {{ $catalogo->titulo }}</h6>
                    <ul class="list-group list-group-flush align-items-center gothamB">
                        <li class="list-group-item bg-transparent">
                            <a href="{{ $catalogo->urlDocumento }}" data-id="{{ $catalogo->id }}" data-tipo="catalogo" download>
                                
                                    <button type="button" id="btnDescargar"
                                    class="btn btn-outline-primary btn-block btn-sm rounded-pill px-3 ">DESCARGAR</button>
                                
                            </a>
                        </li>
                        
                        <!-- <li class="list-group-item  bg-transparent">
                            <a href="{{ route('catalogo.show',$catalogo)  }}">
                                <button type="button" id="btnVerPDF"
                                    class="btn btn-outline-primary btn-block btn-sm rounded-pill px-3">
                                    VER EN LÍNEA
                                </button>
                            </a>
                        </li> -->

                        <li class="list-group-item  bg-transparent">
                            <a href="{{ route('catalogo.show',['catalogo'=> $catalogo->id])  }}">
                                <button type="button" id="btnVerPDF"
                                    class="btn btnCardManual btnVerManual btn-outline-primary btn-block btn-sm rounded-pill px-3">
                                    VER EN LÍNEA
                                </button>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
                
            @empty
                <h4>NINGÚN CATALOGO POR MOSTRAR</h4>
            @endforelse
            @section('pagination')
                {{ $catalogos->links('pagination::simple-bootstrap-5') }}
            @endsection

        </div>
    </div>

    <script src="{{ asset('assets/js/descargasHandler.js')}}" type="module"></script>    
@endsection
