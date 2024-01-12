@extends('adminlte::page')

@section('title', 'Folletos')

@section('content_header')
<h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">FOLLETOS</h3>
@stop

@section('content')
<section class="content container-fluid">
    
    <div class="row flex justify-content-center mt-4">
        <div class="col-md-10">

            <div class="card card-default">
                <div class="card-header bg-admin-card-title ">
                    <span class="card-title font-gothamBold">NUEVO ELEMENTO</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('folletos.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="box box-info padding-1">
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label class="text-secondary">Titulo</label>
                                    <input type="text" name='titulo' class="form-control" placeholder="Titulo" maxlength="254" required>
                                </div>
                                
                                <div class="form-group d-flex flex-col justify-content-between mt-4">
                                    <div class="item-fecha">
                                        <label class="text-secondary">Fecha</label>
                                        <input type="date" name='fecha' class="form-control" placeholder="Fecha">
                                    </div>
                                    <div class="item-estado">
                                        <label class="text-secondary">Estado</label>
                                        <select name="estado" id="idSelect" class="form-control">
                                            <option value="1">Activo</option>
                                            <option value="0">Borrador</option>
                                        </select>
                                    </div>
                                    <div class="item-archivo">
                                        <label class="text-secondary">Folleto</label>
                                        <input type="file" accept="image/jpeg, image/png" name="urlImagen" id="urlImagen" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="item">
                                        <input type="hidden" id="temas" name="temas" value="">
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
                                <button type="submit" class="btn btn-primary ">CREAR</button>
                                <a href="{{ route( "folleto.admin" )}}" class="btn btn-secondary">CANCELAR</a>
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
    <link rel="stylesheet" href=" {{ asset('assets/css/styles.css') }}">
@stop

@section('js')
    <script src="{{ asset('assets/js/multitemas.js') }}"></script>
@stop

