@extends('adminlte::page')

@section('title', 'Autoridad')

@section('content_header')
<h3 class="text-secondary px-2" style="background-color: #fcd5c9">AUTORIDAD</h3>

@stop
@section('content')
<div class="container col-md-10 mt-4">
    <div class="w-100 bg-admin-card-title p-1">
        <a href="{{ route('autoridades.create') }}" class="text-white text-decoration-none font-gothamBold "> 
            +
            NUEVA AUTORIDAD
        </a>
    </div>
    <hr>

    {{ $autoridades->links('pagination::simple-bootstrap-5') }}
    <table class="table table-striped table-hover table-borderless">
        <thead class="p-2 table-primary">
            <tr >
                <th>ACCIONES</th>
                <th>AUTORIDAD</th>
                <th>DESCRIPCION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($autoridades as $autoridad)
                <tr class="m-2">
                    <td>
                        <a href="{{ route('autoridades.edit', $autoridad) }}" class="btn btn-outline-primary rounded-pill">Editar</a>
                        <form action="{{ route('autoridades.destroy', $autoridad) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn bg-btn-red rounded-pill" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                              </svg></button>
                        </form>
                    </td>
                    
                    <td>{{ $autoridad->nombre }}</td>
                    <td>{{ $autoridad->descripcion }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay autoridades</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/css/styles.css') }}">
@stop

@section('js')
    
@stop
