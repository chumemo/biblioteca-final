@extends('layouts.base')

@section('titulo_seccion', 'COMPENDIOS')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center align-items-center">


                    <form action="{{ route('compendio.filtrar') }}" method="POST" class="d-flex flex-row">
                        @method('POST')
                        @csrf
                        
                        <div class="mb-3 me-3">
                            <select id="tema" class="form-select form-select-sm border-gray text-secundary" name="tema"
                                aria-label="Selecciona un tema">
                                <option value="" disabled selected>Tema</option>
                                @foreach ($temas as $tema)
                                    <option value="{{ $tema->id }}" >{{ $tema->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 me-3">
                            <select id="criterio" class="form-select form-select-sm border-gray " name="criterio"
                                aria-label="Selecciona un criterio">
                                <option value="" disabled selected>Criterio</option>
                                @foreach ($criterios as $criterio)
                                    <option value="{{ $criterio->id }}" > {{ $criterio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 me-3">
                            <select id="anio" name="anio" class="form-select form-select-sm border-gray "
                                aria-label="Selecciona un año">
                                <option value="" disabled selected>Año</option>
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

                        <div class="mb-3 me-3">

                            <select id="autoridad" name="autoridad" class="form-select form-select-sm border-gray "
                                aria-label="Selecciona una autoridad">
                                <option value="" disabled selected>Autoridad</option>
                                @foreach ($autoridades as $autoridad)
                                    <option value="{{ $autoridad->id }}">{{ $autoridad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-outline-primary border-gray btn-xsm" type="submit"><label style="color: rgba(var(--bs-secondary-rgb), var(--bs-text-opacity)) !important;">FILTRAR</label></button>
                    </form>
                </div>

                <div class="col-md-12">
                    {{ $compendios->links('pagination::simple-bootstrap-5') }}
                    <table class="table table-header-compendio">
                        <thead>
                            <tr class="table-warning ">
                                <th>TEMA</th>
                                <th>CRITERIO</th>
                                <th>AÑO</th>

                                <th>IDENTIFICACIÓN</th>
                                <th>SÍNTESIS</th>
                                <th>VER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compendios as $compendio)
                                <tr>
                                    <td class="text-secondary">{{ $compendio->temaId->nombre ?? '' }}</td>
                                    <td class="text-secondary">{{ $compendio->criterioId->nombre ?? '' }}</td>
                                    <td class="text-secondary">{{ $compendio->anio }}</td>

                                    <td class="text-identificador">{{ $compendio->titulo }}</td>
                                    <td class="text-secondary">{!! $compendio->descripcion !!}</td>
                                    <!-- <td
                                        class="d-flex text-secundary justify-content-around"@if ($compendio->urlDocumento == null || '') hidden @endif>
                                        <a  href="{{ route('compendio.show', $compendio) }}">                                            
                                            <img src="/assets/img/Ver.png" class="btn-table-ver-compendios" alt="">
                                        </a>
                                        <a class="ml-3" href="{{ '../' . $compendio->urlDocumento }}" data-id="{{ $compendio->id }}"
                                            data-tipo="compendio" download>                                            
                                            <img src="/assets/img/Descarga.png" class="btn-table-ver-compendios" alt="">
                                        </a>
                                    </td> -->
                                    <td
                                        class="d-flex text-secundary justify-content-around">
                                        @if($compendio->urlLink != null)
                                            <a href="{{ $compendio->urlLink }}" target="_blank">                                            
                                                <img src="/assets/img/Ver.png" class="btn-table-ver-compendios" alt="">
                                            </a>
                                        @elseif($compendio->urlDocumento != null)
                                            <a  href="{{ '../' . $compendio->urlDocumento }}" data-id="{{ $compendio->id }}"
                                                data-tipo="compendio" download>                                            
                                                <img src="/assets/img/Descarga.png" class="btn-table-ver-compendios" alt="">
                                            </a>
                                        @else
                                            --
                                        @endif                                                                                
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/descargasHandler.js') }}" type="module"></script>
@endsection
