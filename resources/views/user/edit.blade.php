@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h3 class="text-secondary my-2 px-2" style="background-color: #fcd5c9">USUARIOS</h3>
@stop

@section('content')
    <section class="content container-fluid">

        <div class="row flex justify-content-center mt-4">
            <div class="col-md-10">

                <div class="card card-default">

                    <div class="card-body">
                        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" role="form"
                            enctype="multipart/form-data" id="formEdit">
                            @method('PUT')
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="box box-info padding-1">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label class="text-secondary">Nombre</label>
                                                <input type="text" name='name' class="form-control"
                                                    placeholder="Nombre" required value="{{ $usuario->name }}" maxlength="254">
                                            </div>

                                            <div class="form-group">
                                                <label class="text-secondary">Email</label>
                                                <input type="email" name='email' class="form-control"
                                                    placeholder="Email" required value="{{ $usuario->email }}" maxlength="254">
                                            </div>

                                            <div class="form-group">
                                                <label class="text-secondary">Contraseña</label>
                                                <span id="encriptedId" class="text-secondary"><b> encriptada.</b></span>

                                                <div class="input-group mb-3">
                                                    <input type="password" name='password' class="form-control"
                                                        id="inputPwd" placeholder="Contraseña" required
                                                        value="{{ $usuario->password }}" maxlength="254">
                                                    <span class="input-group-text" id="showIcon"
                                                        onclick="togglePasswordVisibility()">
                                                        <i class="fas fa-eye"></i>
                                                </div>


                                                <button class="btn btn-sm btn-outline-primary rounded-pill mt-1"
                                                    id="btnGenerar">GENERAR NUEVA</button>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-secondary">Rol</label>
                                                <select name="rolSelect" id="rolSelect" class="form-control item">
                                                    @foreach ($roles as $rol)
                                                        <!-- <option value="{{ $rol->id }}"
                                                            {{ $usuario->hasRole($rol->name) ? 'selected' : '' }}>
                                                            {{ $rol->name }}
                                                        </option> -->
                                                        <option value="{{ $rol->id }}"
                                                            {{ $usuario->rol == $rol->id ? 'selected' : '' }}>
                                                            {{ $rol->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="box-footer mt20">
                                            <button type="submit" class="btn btn-primary ">ACTUALIZAR</button>
                                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">CANCELAR</a>
                                        </div>
                                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnGenerar').addEventListener('click', function(e) {
                e.preventDefault();

                let token = document.querySelector('#formEdit input[name="_token"]').value;
                document.getElementById('encriptedId').hidden = true;

                fetch("{{ route('usuario.generatepwd.admin') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('#formEdit input[name="password"]').value = data
                        .password;
                    })
                    .catch(error => {
                        console.error('Error al realizar la solicitud Fetch.', error);
                    });
            });
        });
    </script>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('inputPwd');
            var showIcon = document.getElementById('showIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                showIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordField.type = 'password';
                showIcon.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
    </script>
@stop
