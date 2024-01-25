@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'FORMATOS')

<style>
    tr > th {
        background-color: bg-warning;
    }
</style>
<div class="row">
    <div class="container d-flex flex-row justify-content-center  ">

        <div class="col-md-6">
            <h2 class="mb-2">Detalles del Archivo</h2>

            <table class="table table-hover table-bordered">
                <tbody>

                    <tr>
                        <th>Título</th>
                        <td>{{ $formato->titulo }}</td>
                    </tr>
                    <tr>
                        <th>Tema</th>
                        <td>{{ $formato->tema->nombre ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>Organismo</th>
                        <td>{{ $formato->autoridad->nombre ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Subido por</th>
                        <td>{{ $formato->autor->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td>{{ $formato->fecha }}</td>
                    </tr>
                    <tr>
                        <th>Enlace</th>
                        <td>
                            @if($formato->urlDocumento)
                                <a href="{{ asset($formato->urlDocumento); }}" data-id="{{ $formato->id }}" data-tipo="formato" download>
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
