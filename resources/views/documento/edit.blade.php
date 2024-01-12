@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
<h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">DOCUMENTOS</h3>
@stop

@section('content')
<section class="content container-fluid">
    
    <div class="row flex justify-content-center mt-4">
        <div class="col-md-10">

            <div class="card card-default">

                <div class="card-body">
                    <form method="POST" action="{{ route('documentos.update', $documento) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="text-secondary">Titulo</label>
                                        <input type="text" name='titulo' class="form-control" placeholder="Titulo" value="{{ $documento->titulo }}" maxlength="254"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-secondary">Síntesis</label>
                                        <input type="text" name="descripcion" id="descripcion" hidden value="{{ $documento->descripcion }}">
                                        <trix-editor input="descripcion"></trix-editor>
                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4">
                                        <div class="item-fecha">
                                            <label class="text-secondary">Fecha</label>
                                            <input type="date" name='fecha' class="form-control" placeholder="Fecha" value="{{ $documento->fecha }}">
                                        </div>
                                        <div class="item-estado">
                                            <label class="text-secondary">Estado</label>
                                            <select name="estado" id="idSelect" class="form-control">
                                                <option value="1" {{ $documento->estado == 1 ? 'selected' : '' }}>Activo</option>
                                                <option value="0" {{ $documento->estado == 0 ? 'selected' : '' }}>Borrador</option>
                                            </select>
                                        </div>
                                        <div class="item-archivo">
                                            <label class="text-secondary">imagen</label>
                                            <input type="file" accept="image/jpeg, image/png" name="urlImagen" id="urlImagen" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4">
                                        <div class="item">
                                            <label class="text-secondary">Documento</label>
                                            <input type="file" accept="application/pdf" name="urlDocumento" id="urlDocumento"
                                                class="form-control">
                                        </div>
                                        <!-- <div class="item">
                                            <label class="text-secondary">Tema</label>
                                            <select name="tema" id="temaSelect" class="form-control">
                                                <option value="">Seleccionar tema.</option>
                                                @forelse ($temas as $tema)
                                                    <option value="{{ $tema->id }}"@if ( $tema->id == $documento->temaId)
                                                        selected
                                                    @endif>{{ $tema->nombre }}</option>
                                                @empty
                                                    <option value="">No hay temas.</option>
                                                @endforelse
                                            </select>
                                        </div> -->

                                        <div class="item">
                                            <input type="hidden" id="temas" name="temas" value="{{ $documento->temas }}">
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
                                        <label class="text-secondary">Autoridad</label>
                                        <select name="autoridad" id="autoridadSelect" class="form-control item">
                                            <option value="">Seleccionar autoridad.</option>
                                            @forelse ($autoridades as $autoridad)
                                                    <option value="{{ $autoridad->id }}"@if ( $autoridad->id == $documento->autoridadId)
                                                        selected
                                                    @endif>{{ $autoridad->nombre }}</option>
                                                @empty
                                                    <option value="">No hay autoridades.</option>
                                                @endforelse
                                        </select>
                                        
                                    </div>

                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary ">ACTUALIZAR</button>
                                    <a href="{{ route('documento.admin') }}" class="btn btn-secondary">CANCELAR</a>
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

