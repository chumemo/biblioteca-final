@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'DOCUMENTOS')



<div class="container mt-4">

    <div class="row">
        <!-- <p id="pParam">
            Param aut 
        </p> -->

        <div class="d-flex flex-direction-row align-items-center justify-content-center">
            <ul class="list-inline border border-primary mb-4 p-2 rounded-lg">
                <li class="list-inline-item">
                    <a href="{{ route('documento.index') }}">
                        <button id="btnTodos" class="btn btn-warning text-white p-2 btnAutoridad">TODOS</button>
                        <!-- <button class="btn {{ Request::get('autoridadid') == null ? 'btn-warning text-white p-2' : 'btn-light p-2' }}">TODOS</button> -->
                    </a>
                </li>                
                @foreach ( $autoridades as $autoridad)
                <li class="list-inline-item">
                    <a href="{{ route('documento.index', ['autoridadId' => $autoridad->id]) }}">
                        <button id="btnAutoridad{{$autoridad->id}}" class="btnAutoridad btn btn-light p-2">{{ $autoridad->nombre }}</button>
                        <!-- <button class="btn {{ Request::get('autoridadid') == $autoridad->id ? 'btn-warning text-white p-2' : 'btn-light p-2' }}">{{ $autoridad->nombre }}</button> -->
                    </a>
                </li>
                @endforeach
                {{-- <li class="list-inline-item">
                    <button class="btn btn-light p-2">SCJN</button>
                </li>
                <li class="list-inline-item">
                    <button class="btn btn-light p-2">INE</button>
                </li>
                <li class="list-inline-item">
                    <button class="btn btn-light p-2">IEEG</button>
                </li>
                <li class="list-inline-item">
                    <button class="btn btn-light p-2">TEPJF</button>
                </li>
                <li class="list-inline-item">
                    <button class="btn btn-light p-2">TEEG</button>
                </li>
                <li class="list-inline-item">
                    <button class="btn btn-light p-2">OTROS</button>
                </li> --}}

                {{-- CREACION DE AUTORIDADES POR PARTE DE ADMIN --}}
            </ul>
        </div>





        @forelse ($documentos as $documento)
            <div class="card mb-3 col-md-12 border-fucsia border-1 cardEffect">
                <div class="row g-0">
                    <div class="col-md-2 my-1 p-2">
                        <img src="{{ "../" . $documento->urlImagen }}" width="150px" height="150px" alt="icono documento">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="text-secondary"> {{ $documento->fecha . " | " . $documento->tema}}</p>
                            <p class="cardTitleDocumento text-secondary">{{ $documento->titulo }} </p>
                            <p class="card-text ">{!! $documento->descripcion !!}</p>
                        </div>
                    </div>
                    <div class="col-md-2 my-1 p-2 d-flex flex-col justify-content-center">
                        @if ($documento->urlDocumento == null)
                            <button class="btn btn-secondary rounded-pill" disabled>SIN DOCUMENTO</button>
                        @else
                        <a href="{{ $documento->urlDocumento }}" data-id="{{ $documento->id }}" data-tipo="documento" download>
                            <button id="btnDescargar" class="btn btn-warning text-white rounded-pill">DESCARGAR</button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

        @empty
            <h4>NINGUN documento POR MOSTRAR</h4>
        @endforelse

        @section('pagination')
            {{ $documentos->links('pagination::simple-bootstrap-5') }}
        @endsection
    </div>
</div>
<script src="{{ asset('assets/js/descargasHandler.js')}}" type="module"></script>  

<script>
    
    // recorre todos los bototnes btnAutoridad y les quita la clase btm-warning
    // y les agrega la clase btn-light
    let btnAutoridades = document.querySelectorAll(".btnAutoridad");
    btnAutoridades.forEach(btn => {
        btn.classList.remove("btn-warning");
        btn.classList.remove("text-white");
        btn.classList.add("btn-light");
    });

    let param = "";
    if (window.location.search) {
        param = window.location.search.split("=")[1];
        // console.log('param ', param);
        // document.getElementById("pParam").innerHTML = "Param aut " + param;
        document.getElementById("btnAutoridad" + param).classList.remove("btn-light");
        document.getElementById("btnAutoridad" + param).classList.add("btn-warning");
        document.getElementById("btnAutoridad" + param).classList.add("text-white");
    }else{
        console.log('no param');
        document.getElementById("btnTodos").classList.remove("btn-light");
        document.getElementById("btnTodos").classList.add("btn-warning");
        document.getElementById("btnTodos").classList.add("text-white");
    }

</script>

@endsection
