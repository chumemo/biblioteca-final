@extends('adminlte::page')

@section('title', 'Formatos')

@section('content_header')
    <h2 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">Formato</h2>

@stop

@section('content')
    <section class="content container-fluid">
        <div class="row flex justify-content-center">
            <div class="col-md-10">

                <div class="card card-default">

                    <div class="card-body">
                        <form method="POST" action="{{ route('formatos.update', $formato) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="text-secondary">Titulo</label>
                                        <input type="text" name='titulo' class="form-control" placeholder="Titulo"
                                            value="{{ $formato->titulo }}" maxlength="254" required>
                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4">
                                        <div class="item-fecha">
                                            <label class="text-secondary">Fecha</label>
                                            <input type="date" name='fecha' class="form-control" placeholder="Fecha"
                                                value="{{ $formato->fecha }}">
                                        </div>

                                        <div class="item-estado">
                                            <label class="text-secondary">Estado</label>
                                            <select name="estado" id="idSelect" class="form-control">
                                                <option value="1" @if ($formato->estado == 1) selected @endif>
                                                    Activo</option>
                                                <option value="0"@if ($formato->estado == 0) selected @endif>
                                                    Borrador</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group d-flex flex-col justify-content-between mt-4">
                                        <div class="">
                                            <label class="text-secondary">Archivo</label>
                                            <input type="file" accept=".doc, .docx, .ppt, .pptx, .xls, .xlsx, .pdf" name="urlArchivo" id="urlArchivo" class="form-control"
                                                value="{{ $formato->urlDocumento }}">
                                        </div>

                                        <!-- <div class="item">
                                            <label class="text-secondary">Tema</label>
                                            <select name="tema" id="idTemaSelect" class="form-control item">
                                                <option value="" @if ($formato->temaId == "")
                                                    selected
                                                @endif>Seleccionar tema</option>
                                                @forelse ($temas as $tema)
                                                    <option value="{{ $tema->id }}"
                                                        @if ($tema->id == $formato->temaId) selected @endif>
                                                        {{ $tema->nombre }}</option>
                                                @empty
                                                    <option value="0">No hay temas registrados.</option>
                                                @endforelse
                                            </select>
                                        </div> -->

                                        <div class="item">
                                            <input type="hidden" id="temas" name="temas" value="{{$formato->temas}}">
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

                                    <div class="form-group">
                                        <label class="text-secondary">Organismo</label>
                                        <select name="autoridad" id="idOrganizacionSelect" class="form-control item">
                                            <option value="" @if ($formato->autoridadId == "")
                                                selected
                                            @endif>Seleccionar organismo</option>
                                            @forelse ($autoridades as $autoridad)
                                                    <option value="{{ $autoridad->id }}"
                                                        @if ($autoridad->id == $formato->autoridadId) selected @endif>
                                                        {{ $autoridad->nombre }}</option>
                                                @empty
                                                    <option value="0">No hay autoridades registradas.</option>
                                                @endforelse
                                        </select>
                                    </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                                    <a href="{{ route('formato.admin') }}" class="btn btn-secondary">CANCELAR</a>
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
    </script>

<script src="{{ asset('assets/js/multitemas.js') }}"></script>
@stop
