@extends('adminlte::page')

@section('title', 'Compendios')

@section('content_header')

@stop

@section('content')
    <h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">COMPENDIOS</h3>
    <section class="content container-fluid mt-3">
        <div class="row flex justify-content-center">
            <div class="col-md-10">

                <div class="card card-default">
                    <div class="card-header bg-admin-card-title ">
                        <span class="card-title font-gothamBold">NUEVO COMPENDIO</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('compendio.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group d-flex">
                                        <div class="form-group mr-2">
                                            <label class="text-secondary">Autoridad</label>
                                            <select name="autoridad" id="autoridadSelect" class="form-select item">
                                                @forelse ($autoridades as $autoridad)
                                                    <option value="{{ $autoridad->id }}">{{ $autoridad->nombre }} </option>
                                                @empty
                                                    <option value="0">No hay autoridades registradas </option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label class="text-secondary">Identificación</label>
                                            <input type="text" name='titulo' class="form-control"
                                                placeholder="Identificación" maxlength="254" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="text-secondary">Síntesis</label>
                                        <input type="text" name="descripcion" id="descripcion" hidden>
                                        <trix-editor input="descripcion"></trix-editor>
                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4 flex-wrap">

                                        <div class="item-fecha">
                                            <label class="text-secondary">Año</label>
                                            <select class="form-select" name="anio" required>
                                                @php
                                                    $currentYear = date('Y');
                                                    $startYear = $currentYear;
                                                    $endYear = $currentYear - 40; 
                                                @endphp

                                                @for ($year = $startYear; $year >= $endYear; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>


                                        <div class="item-estado">
                                            <label class="text-secondary">Estado</label>
                                            <select name="estado" id="idSelect" class="form-select">
                                                <option value="1">Activo</option>
                                                <option value="0">Borrador</option>
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
                                                    <option value="{{ $criterio->id }}">{{ $criterio->nombre }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="item-archivo">
                                            <label class="text-secondary">Documento pdf</label>
                                            <input type="file" name="urlDocumento" id="urlDocumento" class="form-control"
                                                accept="application/pdf">
                                        </div>

                                    </div>

                                    <div class="form-group d-flex flex-col justify-content-between mt-4 flex-wrap">

                                        <div class="item">
                                            <label class="text-secondary">Tema</label>
                                            <select name="tema" id="temaId" class="form-select">
                                                <option value="0"></option>
                                                @foreach ($temas as $tema)
                                                    <option value="{{ $tema->id }}">{{ $tema->nombre }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="item-archivo">
                                            <label class="text-secondary">Url Enlace</label>
                                            <input type="text" name='urlLink' class="form-control"
                                                placeholder="Url Enlace" maxlength="200" >
                                        </div>
                                        

                                    </div>

                                    <div class="box-footer mt20 ">
                                        <button type="submit" class="btn btn-primary ">CREAR</button>
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
@stop
