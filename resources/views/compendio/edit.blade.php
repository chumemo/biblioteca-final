@extends('adminlte::page')

@section('title', 'Compendios')

@section('content_header')
    <h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">Compendio</h3>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row flex justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-body">
                        <form method="POST" action="{{ route('compendio.update', $compendio) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group d-flex">
                                        <div class="form-group mr-2">
                                            <label class="text-secondary">Autoridad</label>
                                            <select name="autoridad" id="autoridadSelect" class="form-control item">
                                                @forelse ($autoridades as $autoridad)
                                                    <option value="{{ $autoridad->id }}"
                                                        @if ($autoridad->id == $compendio->autoridad) selected @endif>
                                                        {{ $autoridad->nombre }} </option>
                                                @empty
                                                    <option value="-1">No hay autoridades registradas </option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label class="text-secondary">Identificación</label>
                                            <input type="text" name='titulo' class="form-control"
                                                placeholder="Identificación" maxlength="254" required value="{{ $compendio->titulo }}">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="text-secondary">Síntesis</label>
                                        <input type="text" name="descripcion" id="descripcion" hidden
                                            value="{{ $compendio->descripcion }}">
                                        <trix-editor input="descripcion" value="text"></trix-editor>
                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4 flex-wrap">

                                        <div class="item-fecha">
                                            <label class="text-secondary">Año</label>
                                            <select class="form-control" name="anio" required>
                                                @php
                                                    $currentYear = date('Y');
                                                    $startYear = $currentYear;
                                                    $endYear = $currentYear - 40; 
                                                @endphp

                                                @for ($year = $startYear; $year >= $endYear; $year--)
                                                    <option value="{{ $year }}"
                                                        @if ($year == $compendio->anio) selected="selected" @endif>
                                                        {{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>


                                        <div class="item-estado">
                                            <label class="text-secondary">Estado</label>
                                            <select name="estado" id="idSelect" class="form-control">
                                                <option value="1" @if ($compendio->estado == 1)
                                                    selected="selected" @endif>Activo</option>
                                                <option value="0" @if ($compendio->estado == 0)
                                                    selected="selected" @endif>Borrador</option>
                                            </select>
                                        </div>

                                        <div class="item-archivo">
                                            <label class="text-secondary">Archivo de imagen</label>
                                            <input type="file" name="urlImagen" id="urlImagen" class="form-control"
                                                accept="image/jpeg, image/png">
                                        </div>

                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4 flex-wrap">

                                        <div class="item">
                                            <label class="text-secondary">Criterio</label>
                                            <select name="criterio" id="criterioId" class="form-select">
                                                <option value="0"></option>   
                                                @foreach ($criterios as $criterio)
                                                    <option value="{{ $criterio->id }}" @if ($criterio->id == $compendio->criterio) selected
                                                        
                                                    @endif>{{ $criterio->nombre }}</option> 
                                                @endforeach

                                            </select>


                                        </div>

                                        <div class="item-archivo">
                                            <label class="text-secondary">Documento PDF</label>
                                            <input type="file" name="urlDocumento" id="urlDocumento" class="form-control"
                                                accept="application/pdf">
                                        </div>

                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4 flex-wrap">

                                        <!-- <div class="item">
                                            <label class="text-secondary">Tema</label>
                                            <select name="tema" id="temaId" class="form-select">
                                                <option value="0"></option>
                                                @foreach ($temas as $tema)
                                                    <option value="{{ $tema->id }}">{{ $tema->nombre }}</option>
                                                @endforeach

                                            </select>

                                        </div> -->

                                        <div class="item">
                                            <input type="hidden" id="temas" name="temas" value="{{ $compendio->temas }}">
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

                                        <div class="item-archivo">
                                            <label class="text-secondary">Url Enlace</label>
                                            <input type="text" name='urlLink' class="form-control"
                                                placeholder="Url Enlace" maxlength="200"  value="{{ $compendio->urlLink }}">
                                        </div>
                                        

                                    </div>


                                    <div class="box-footer mt20 ">
                                        <button type="submit" class="btn btn-primary ">ACTUALIZAR</button>
                                        <a href="{{ route('compendio.admin') }}" class="btn btn-secondary">CANCELAR</a>
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
    <link rel="stylesheet" href="{{ asset('assets/css/trix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
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
