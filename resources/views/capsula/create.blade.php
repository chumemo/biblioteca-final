@extends('adminlte::page')

@section('title', 'Capsulas')

@section('content_header')
    
@stop

@section('content')
<section class="content container-fluid">
    <div class="row flex justify-content-center">
        <div class="col-md-10">
            <h2 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">Capsulas</h2>

            <div class="card card-default">
                <div class="card-header bg-admin-card-title ">
                    <span class="card-title font-gothamBold">NUEVO ELEMENTO</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('capsulas.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="box box-info padding-1">
                            <div class="box-body">
                                
                                <div class="form-group">
                                    <label class="text-secondary">Titulo</label>
                                    <input type="text" name='titulo' class="form-control" placeholder="Titulo" maxlength="254" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="text-secondary">Síntesis</label>
                                    <input type="text" name="descripcion" id="descripcion" hidden>
                                    <trix-editor input="descripcion"></trix-editor>
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
                                        <label class="text-secondary">imagen</label>
                                        <input type="file" accept="image/jpeg, image/png" name="urlImagen" id="urlImagen" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="text-secondary">Enlace</label>
                                    <input type="text" name='url' class="form-control" placeholder="Iframe">
                                </div>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">CREAR</button>
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

