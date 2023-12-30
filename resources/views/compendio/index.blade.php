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
                            <select id="criterio" class="form-select form-select-sm border-primary " name="criterio"
                                aria-label="Selecciona un criterio">
                                <option value="" disabled selected>Criterio</option>
                                @foreach ($criterios as $criterio)
                                    <option value="{{ $criterio->id }}">{{ $criterio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 me-3">
                            <select id="anio" name="anio" class="form-select form-select-sm border-primary "
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

                            <select id="autoridad" name="autoridad" class="form-select form-select-sm border-primary "
                                aria-label="Selecciona una autoridad">
                                <option value="" disabled selected>Autoridad</option>
                                @foreach ($autoridades as $autoridad)
                                    <option value="{{ $autoridad->id }}">{{ $autoridad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-outline-primary btn-xsm " type="submit">FILTRAR</button>
                    </form>
                </div>

                <div class="col-md-12">
                    {{ $compendios->links('pagination::simple-bootstrap-5') }}
                    <table class="table table-header-compendio">
                        <thead>
                            <tr class="table-warning ">
                                <th>CRITERIO</th>
                                <th>AÑO</th>

                                <th>IDENTIFICACIÓN</th>
                                <th>SÍNTESIS</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compendios as $compendio)
                                <tr>
                                    <td>{{ $compendio->criterioId->nombre ?? '' }}</td>
                                    <td>{{ $compendio->anio }}</td>

                                    <td>{{ $compendio->titulo }}</td>
                                    <td>{!! $compendio->descripcion !!}</td>
                                    <td
                                        class="d-flex justify-content-around"@if ($compendio->urlDocumento == null || '') hidden @endif>
                                        <a  href="{{ route('compendio.show', $compendio) }}">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg> -->
                                            <img src="assets/img/Ver.png" class="btn-table-ver-compendios" alt="">
                                        </a>
                                        <a class="ml-3" href="{{ '../' . $compendio->urlDocumento }}" data-id="{{ $compendio->id }}"
                                            data-tipo="compendio" download>
                                            <!-- <svg id="btnDescargar" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                <path
                                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                            </svg> -->
                                            <img src="assets/img/Descarga.png" class="btn-table-ver-compendios" alt="">
                                        </a>
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
