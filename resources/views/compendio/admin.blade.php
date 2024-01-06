@extends('adminlte::page')

@section('title', 'Compendios')

@section('content_header')
    <h3 class="text-secondary px-2" style="background-color: #fcd5c9">COMPENDIOS</h3>
@stop
@section('content')
    <div class="container col-md-12">
        <div class="w-100 bg-admin-card-title p-1">
            <a href="{{ route('compendio.create') }}" class="text-white text-decoration-none font-gothamBold ">
                +
                NUEVO COMPENDIO
            </a>
        </div>
        <hr>

        {{ $compendios->links('pagination::simple-bootstrap-5') }}
        <table class="table table-striped table-hover table-borderless">
            <thead class="p-2 table-primary">
                <tr>
                    <th class="acciones">ACCIONES</th>
                    <th>ESTADO</th>
                    <th>AÑO</th>
                    <th>AUTOR</th>
                    {{-- <th>AREA</th> --}}
                    <th>IDENTIFICACION</th>
                    <th>SINTESIS</th>
                    <th>TEMA</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compendios as $compendio)
                    <tr class="m-2">
                        <td>
                            <a href="{{ route('compendio.edit', $compendio) }}"
                                class="btn btn-outline-primary rounded-pill">Editar</a>
                            <form action="{{ route('compendio.destroy', $compendio) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn bg-btn-red rounded-pill" type="submit"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg></button>
                            </form>
                        </td>
                        <td>
                            @if ($compendio->estado == 1)
                                Activo
                            @else
                                Borrador
                            @endif
                        </td>
                        <td>{{ $compendio->anio }}</td>
                        <td>{{ $compendio->autor->name }}</td>

                        <td>{{ $compendio->titulo }}</td>
                        <td >
                            {!! $compendio->descripcion !!}
                            
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal" id="link" >Ver más</a>

                        </td>
                        <td>
                            @if ($compendio->tema != null && $temas != null)
                                 {{ $temas->find($compendio->tema)->nombre }}                                                                 
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            @if ($compendio->urlDocumento == null)
                                <p class="text-danger">No hay documento</p>
                            @else
                                <a href="{{ '../' . $compendio->urlDocumento }}"
                                    download="{{ $compendio->titulo . '.pdf' }}">
                                    <button id="btnDescargar" class="btn btn-outline-primary ">
                                        Descargar
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay compendios</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>





    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="modalTitle"  class="modal-title fs-5"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalContent" class="modal-body">
                    
                </div>
                
            </div>
        </div>
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/css/styles.css') }}">
    <style>
        td > div {
            max-width: 400px !important;
            max-height: 3em !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }
    </style>

@stop

@section('js')
    <script>
        let links = document.querySelectorAll('a[data-bs-target="#modal"]');
        let modalTitle = document.querySelector('#modalTitle');
        let modalContent = document.querySelector('#modalContent');
        
        links.forEach(link => {
            
        
            link.addEventListener('click', (e)=>{
                let p = link.previousElementSibling;
                console.log(p);
                modalTitle.innerHTML = link.parentElement.previousElementSibling.innerHTML;
                if(p) modalContent.innerHTML = p.innerHTML;
                else modalContent.innerHTML = "<p>No hay sintesis</p>"
            })

        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@stop
