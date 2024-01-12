@extends('adminlte::page')

@section('title', 'Manuales')

@section('content_header')
<h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">MANUALES</h3>
@stop

@section('content')
<section class="content container-fluid">
    
    <div class="row flex justify-content-center mt-4">
        <div class="col-md-10">

            <div class="card card-default">

                <div class="card-body">
                    <form method="POST" action="{{ route('manuales.update', $manual->id) }}"  role="form" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="box box-info padding-1">
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label class="text-secondary">Titulo</label>
                                    <input type="text" name='titulo' class="form-control" placeholder="Titulo" maxlength="254" required value="{{$manual->titulo}}">
                                </div>
                                
                                <div class="form-group d-flex flex-col justify-content-between mt-4">
                                    <div class="item-fecha">
                                        <label class="text-secondary">Fecha</label>
                                        <input type="date" name='fecha' class="form-control" placeholder="Fecha" value="{{ $manual->fecha }}">
                                    </div>
                                    <div class="item-estado">
                                        <label class="text-secondary">Estado</label>
                                        <select name="estado" id="idSelect" class="form-control" value="{{ $manual->estado }}">
            
                                            <option value="1" @if ($manual->estado == 1)
                                                selected="selected" @endif>Activo</option>
                                            <option value="0" @if ($manual->estado == 0)
                                                selected="selected" @endif>Borrador</option>
                                            
                                        </select>
                                        <script>console.log("{{ $manual->estado }}")</script>
                                    </div>
                                    <div class="item-archivo">
                                        <label class="text-secondary">imagen</label>
                                        <input type="file" accept="image/jpeg, image/png" name="urlImagen" id="urlImagen" class="form-control" value="{{ $manual->urlImagen }}">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="text-secondary">Documento</label>
                                    <input type="file" accept="application/pdf" name="urlDocumento" id="urlDocumento" class="form-control" value="{{ $manual->urlDocumento }}">
                                </div>

                                <div class="form-group">
                                    <div class="item">
                                        <input type="hidden" id="temas" name="temas" value="{{ $manual->temas }}">
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
                                <button type="submit" class="btn btn-primary ">ACTUALIZAR</button>
                                <a href="{{ route( "manual.admin" )}}" class="btn btn-secondary">CANCELAR</a>
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

