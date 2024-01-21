@extends('layouts.base')

@section('content')
    <div class="row col-lg-12 justify-content-center align-content-center">

        <style>
            .card {
                position: relative;
            }
        
            .card-img-overlay {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                align-items: flex-start;
                height: 100%;
                padding: 1rem;
                transition: transform 0.3s ease-in-out;
                transform: translateY(0);
            }
        
            .card:hover .card-img-overlay {
                transform: translateY(-10%);
            }
        
            .card-title {
                opacity: 1;
                transition: opacity 0.5s ease-in-out;
            }
        
            .card-text {
                opacity: 0;
                display: none;
                transition: opacity 0.5s ease-in-out;
            }
        
            .card:hover .card-text {
                display: block;
                opacity: 1;
            }
        </style>
        


        <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0" style="max-height: 300px; max-width: 350px">
            <a href="{{ route('manual.index') }}" class="card-link">
                <img src="{{ asset('assets/img/Mosaico-Manuales.png') }}" class="card-img img-fluid rounded-0 " alt="Manuales" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end">
                        <img class="mr-2" src="{{ asset('assets/img/ICONO-Manuales.png') }}" alt="icono manuales" width="50px">
                        <h5 class="card-title gothamR text-primary">
                            MANUALES
                        </h5>
                    </div>
                    <p class="card-text text-primary">Manuales de operación de apoyo para la integración de un procedimiento especial sancionador y las notificaciones en el instituto.</p>
                </div>
            </a>
        </div>
        


        <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0" style="max-height: 300px; max-width: 350px">
            <a href="{{ route('folleto.index') }}">
                <img src="{{ asset('assets/img/Mosaico-Folletos.png') }}" class="card-img img-fluid rounded-0 " alt="Manuales" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end">
                        <img class="mr-2" src="{{ asset('assets/img/ICONO-Folletos.png') }}" alt="icono Folletos" width="50px">
                        <h5 class="card-title  gothamR text-cream">
                            FOLLETOS
                        </h5>
                    </div>

                    <p class="card-text text-cream">Material didáctico e infografías en materia de procedimiento especial sancionador.</p>

                </div>
            </a>
        </div>



        {{-- <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0 " style="max-height: 300px; max-width: 350px">
            <a href="{{ route('formato.index') }}">
                <img src="{{ asset('assets/img/Mosaico-Formatos.png') }}" class="card-img img-fluid rounded-0 "
                    alt="Manuales" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end ">
                        <img class="" src="{{ asset('assets/img/ICONO-Formatos.png') }}" alt="icono manuales"
                            width="50px">
                        <h5 class="card-title gothamR text-primary">FORMATOS</h5>
                    </div>
                    <p class="card-text text-primary">Documentos digitales en versión editable que pueden ser descargados por las y los usuarios del sitio con el propósito de agilizar su elaboración.</p>
                </div>
            </a>
        </div> --}}

        <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0" style="max-height: 300px; max-width: 350px">
            <a href="{{ route('formato.index') }}">
                <img src="{{ asset('assets/img/Mosaico-Formatos.png') }}" class="card-img img-fluid rounded-0 " alt="Formatos" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end">
                        <img class="mr-2" src="{{ asset('assets/img/ICONO-Formatos.png') }}" alt="icono formatos" width="50px">
                        <h5 class="card-title  gothamR text-primary">
                            FORMATOS
                        </h5>
                    </div>
                    <p class="card-text text-primary">Documentos digitales en versión editable que pueden ser descargados por las y los usuarios del sitio con el propósito de agilizar su elaboración.</p>
                </div>
            </a>
        </div>



        <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0 " style="max-height: 300px; max-width: 350px">
            <a href="{{ route('catalogo.index') }}">
                <img src="{{ asset('assets/img/Mosaico-Catalogos.png') }}" class="card-img img-fluid rounded-0 "
                    alt="Manuales" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end ">
                        <img class="" src="{{ asset('assets/img/ICONO-Catalogo.png') }}" alt="icono manuales"
                            width="50px">
                        <h5 class="card-title gothamR text-cream">CATÁLOGOS</h5>
                    </div>
                    <p class="card-text text-cream">Conjunto de infracciones aplicables en el procedimiento especial sancionador</p>
                </div>
            </a>
        </div>


        <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0 " style="max-height: 300px; max-width: 350px">
            <a href="{{ route('documento.index') }}">
                <img src="{{ asset('assets/img/Mosaico-Documentos.png') }}" class="card-img img-fluid rounded-0 "
                    alt="Manuales" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end ">
                        <img class="" src="{{ asset('assets/img/ICONO-Documentos.png') }}" alt="icono manuales"
                            width="50px">
                        <h5 class="card-title gothamR text-primary">DOCUMENTOS</h5>
                    </div>
                    <p class="card-text text-primary">Información relacionada con procedimiento especial sancionador aplicable en el estado de Guanajuato de autoridades electorales como SCJN, INE, IEEG, TEPJF Y TEEG.</p>
                </div>
            </a>
        </div>

        <div class="card text-bg-dark col-lg-4 border-0 rounded-0 p-0 " style="max-height: 300px; max-width: 350px">
            <a href="{{ route('compendio.index') }}">
                <img src="{{ asset('assets/img/Mosaico-Compendios.png') }}" class="card-img img-fluid rounded-0 "
                    alt="Manuales" style="max-width: 350px">
                <div class="card-img-overlay d-flex flex-column justify-content-end cardEffect">
                    <div class="d-flex align-items-end ">
                        <img class="" src="{{ asset('assets/img/ICONO-Compendios.png') }}" alt="icono manuales"
                            width="50px">
                        <h5 class="card-title gothamR text-cream">COMPENDIOS</h5>
                    </div>
                    
                    <p class="card-text text-cream">Información relacionada con procedimiento especial sancionador aplicable en el estado de Guanajuato de autoridades electorales como SCJN, INE, IEEG, TEPJF Y TEEG.</p>

                </div>
            </a>
        </div>
        
    </div>
    {{-- Carousell --}}
    @if (count($capsulas) == 0)
        {{-- No hay capsulas --}}
    @else
    <br>
    <div class="w-100 bg-admin-section-title p-2">
        CÁPSULAS INFORMATIVAS
    </div> 
        <div id="carousel" class="carousel slide carousel-fade px-lg-5 my-2 d-flex align-items-center ">
            <div class="carousel-inner mx-lg-5">

                @foreach ($capsulas as $capsula)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <div class="card p-5 border-0">
                            <div class="row">

                                <div class="col-md-6">
                                    <!-- Video -->
                                    <iframe width="100%" height="315" src="{{ $capsula->url }}}" frameborder="0"
                                        allowfullscreen></iframe>
                                </div>
                                <div class="col-md-6">
                                    <!-- Contenido derecho -->
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $capsula->titulo }}</h5>
                                        <p class="card-text">{!! $capsula->descripcion !!}</p>
                                        <hr>
                                        <p class="card-text"><small class="text-muted">Octubre 19, 2023</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark " aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script>
            // // Carousel video playback
            // let iframes = document.querySelectorAll('iframe');
            // let iframesSrc = [];
            // iframes.forEach(iframe => {
            //     iframesSrc.push(iframe.src);
            // });
            // document.querySelector('#carousel').addEventListener('slide.bs.carousel', function(e) {
            //     iframes.forEach(iframe => {
            //         let temp = iframe.src;
            //         iframe.src = '';
            //         iframe.src = temp;
            //     });

            // });
        </script>

        </div>

        <div class="container d-flex flex-column  align-items-center mb-6">
            <a href="{{ route('capsula.index') }}">
                <button type="button" id="irACapsulas"
                    class="btn btn-outline-primary btn-block btn-sm rounded-pill px-3">
                    VER MÁS
                </button>
            </a>
        </div>
    @endif


@endsection
