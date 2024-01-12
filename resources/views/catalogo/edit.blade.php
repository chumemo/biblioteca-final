@extends('adminlte::page')

@section('title', 'Catalogos')

@section('content_header')
    <h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">CATALOGOS</h3>
@stop

@section('content')
    <section class="content container-fluid">

        <div class="row flex justify-content-center mt-4">
            <div class="col-md-10">

                <div class="card card-default">

                    <div class="card-body">
                        <form method="POST" action="{{ route('catalogos.update', $catalogo->id) }}" role="form"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="text-secondary">Titulo</label>
                                        <input type="text" name='titulo' class="form-control" placeholder="Titulo"
                                            required value="{{ $catalogo->titulo }}" maxlength="254">
                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4">
                                        <div class="item-fecha">
                                            <label class="text-secondary">Fecha</label>
                                            <input type="date" name='fecha' class="form-control" placeholder="Fecha" value="{{ $catalogo->fecha }}">
                                        </div>
                                        <div class="item-estado">
                                            <label class="text-secondary">Estado</label>
                                            <select name="estado" id="idSelect" class="form-control">
                                                <option value="1" @if ($catalogo->estado == 1)
                                                    selected="selected" @endif>Activo</option>
                                                <option value="0" @if ($catalogo->estado == 0)
                                                    selected="selected" @endif>Borrador</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group d-flex flex-col justify-content-between mt-4">
                                        <div class="">
                                            <label class="text-secondary">Archivo</label>
                                            <span id="nombreArchivo">Text</span>
                                            <!-- <input type="file" accept="application/pdf" name="urlArchivo" id="urlArchivo" class="form-control" value="{{ $catalogo->urlDocumento }}"> -->
                                            <input type="file"  accept=".doc, .docx, .ppt, .pptx, .xls, .xlsx, .pdf"  name="urlArchivo" id="urlArchivo" class="form-control" value="{{ $catalogo->urlDocumento }}">                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <div class="item">
                                        <input type="hidden" id="temas" name="temas" value="{{ $catalogo->temas }}">
                                        <label class="text-secondary">Temas</label>
                                        
                                        <div class="search-container">
                                            <div id="selected-items"></div>            
                                            <input type="text" class="search-box" id="search-box" placeholder="Buscar temas" autocomplete="off" />
                                            <div class="suggestions">
                                                @foreach ($temas as $tema)                                                        
                                                    <span class="suggestion">{{ $tema->nombre }}</span>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">CREAR</button>
                                    <a href="{{ route('catalogo.admin') }}" class="btn btn-secondary">CANCELAR</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/css/trix.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/css/styles.css') }}">
@stop

@section('js')
    <script src="{{ asset('assets/js/trix.umd.min.js') }}"></script>

    <script>
        document.addEventListener("trix-initialize", function(event) {
            var trix = event.target;
            trix.toolbarElement.querySelector(".trix-button-group--file-tools").style.display = "none";
        });
        
        
        const $seleccionArchivos = document.querySelector("#urlArchivo");
        console.log($seleccionArchivos);
        
        const $nombreArchivo = document.querySelector("#nombreArchivo");
        
        $nombreArchivo.textContent = $seleccionArchivos.value;
        
    </script>
        
        <script src="{{ asset('assets/js/multitemas.js') }}"></script>
@stop
