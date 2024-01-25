@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'DOCUMENTOS')

<style>
    tr > th {
        background-color: bg-warning;
    }
</style>
<div class="row">
    <div class="container d-flex flex-row justify-content-center  ">

        <div class="col-md-6">
            <h2 class="mb-2">Detalles del documento</h2>

            <table class="table table-hover table-bordered">
                <tbody>

                    <tr>
                        <th>Título</th>
                        <td>{{ $documento->titulo }}</td>
                    </tr>
                    <tr>
                        <th>Tema</th>
                        <td>{{ $documento->tema->nombre ?? 'Sin tema' }}</td>
                    </tr>
                    <tr>
                        <th>Organismo</th>
                        <td>{{ $documento->autoridad->nombre ?? 'Sin autoridad vinculada' }}</td>
                    </tr>
                    <tr>
                        <th>Descripción</th>
                        <td>{!! $documento->descripcion !!}</td>
                    </tr>
                    <tr>
                        <th>Subido por</th>
                        <td>{{ $documento->autor->name }}</td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td>{{ $documento->fecha }}</td>
                    </tr>
                    <tr>
                        <th>Enlace</th>
                        <td>
                            <!-- <a href="{{ asset($documento->urlDocumento); }}" data-id="{{ $documento->id }}" data-tipo="documento" download>
                                <button id="btnDescargar" type="button"
                                    class="btn btn-warning text-morado hover:text-white btn-block btn-sm rounded-pill px-3">DESCARGAR</button>
                            </a> -->

                            @if($documento->urlDocumento)
                                <a href="{{ asset($documento->urlDocumento); }}" data-id="{{ $documento->id }}" data-tipo="formato" download>
                                    <button id="btnDescargar" type="button"
                                        class="btn btn-warning text-morado hover:text-white btn-block btn-sm rounded-pill px-3">DESCARGAR</button>
                                </a>
                            @endif

                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script src="{{ asset('assets/js/descargasHandler.js')}}" type="module"></script>  
@endsection
