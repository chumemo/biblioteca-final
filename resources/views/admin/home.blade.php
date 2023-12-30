@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-md-12 d-flex flex-row">
                <form class="form d-flex flex-row justify-content-between " action="/estadistica/buscar/usuario" method="POST">
                    @method('POST')
                    @csrf
                    <input class="form-control mr-2" type="text" placeholder="Filtrar por email" name="correo" maxlength="254">
                    <button class="form-control btn btn-primary " type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 d-flex flex-row justify-content-around">
                <div class="col-4 border-dark m-2">
                    <h6>Descargas por tipo</h6>
                    <canvas width="500px" height="400px" id="descargasCanvas"></canvas>
                </div>
                <div class="col-4 border-dark m-2">
                    <h6>Lecturas por tipo</h6>
                    <canvas width="500px" height="400px" id="lecturasCanvas"></canvas>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex flex-row justify-content-around">
                <div class="col-4 border-dark m-2">
                    <h6>Descargas de usuarios</h6>
                    <canvas width="500px" height="400px" id="descargasUsuarioCanvas"></canvas>
                </div>
                <div class="col-4 border-dark m-2">
                    <h6>Lecturas de usuarios</h6>
                    <canvas width="500px" height="400px" id="lecturasUsuarioCanvas"></canvas>
                </div>

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const GENERAL = 1,
            USUARIO = 2,
            CATEGORIA = 3;

        let csrfToken = null;
        let csrfMetaTag = document.querySelector('meta[name="csrf-token"]');

        if (csrfMetaTag) {
            csrfToken = csrfMetaTag.getAttribute('content');
        } else {
            console.error('No se encontró el elemento meta con name="csrf-token"');
        }


        let ctxDescargas = document.getElementById('descargasCanvas');
        let ctxLecturas = document.getElementById('lecturasCanvas');
        let ctxDescargasUsuario = document.getElementById('descargasUsuarioCanvas');
        let ctxLecturasUsuario = document.getElementById('lecturasUsuarioCanvas');

        //Handlers
        document.addEventListener('DOMContentLoaded', handleOnLoaded);

        async function handleOnLoaded() {
            try {
                const data = await enviarSolicitud('/estadistica/' + GENERAL);
                mostrarDataDescargasLecturas(data);

                const dataUsuarios = await enviarSolicitud('/estadistica/' + USUARIO);
                mostrarDataUsuariosDescargasLecturas(dataUsuarios)

            } catch (error) {
                console.error('Error al consultar datos:', error);
            }
        }


        function enviarSolicitud(url) {
            return fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La solicitud no fue exitosa.');
                    }
                    return response.json();
                });
        }

        function mostrarDataDescargasLecturas(data) {

            new Chart(ctxDescargas, {
                type: 'bar',
                data: {
                    labels: ['Catalogos', 'Compendios', 'Documentos', 'Formatos', 'Manuales'],
                    datasets: [{
                        label: 'Descargas',
                        data: [
                            data.descargas.catalogo,
                            data.descargas.compendio,
                            data.descargas.documento,
                            data.descargas.formato,
                            data.descargas.manual
                        ],
                        backgroundColor: 'rgba(93, 18, 80, 0.5)',
                        borderColor: 'rgba(241, 51, 97, 7)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            new Chart(ctxLecturas, {
                type: 'bar',
                data: {
                    labels: ['Capsulas', 'Catalogos', 'Compendios', 'Documentos', 'Formatos',
                        'Manuales'
                    ],
                    datasets: [{
                        label: 'Lecturas',
                        data: [
                            data.lecturas.capsula,
                            data.lecturas.catalogo,
                            data.lecturas.compendio,
                            data.lecturas.documento,
                            data.lecturas.formato,
                            data.lecturas.manual,
                        ],
                        backgroundColor: 'rgba(93, 18, 80, 0.5)',
                        borderColor: 'rgba(241, 51, 97, 7)',
                        borderWidth: 1

                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function mostrarDataUsuariosDescargasLecturas(dataUsuarios) {
            const usuariosDescargas = dataUsuarios.usuarioDescargas;
            const usuariosLecturas = dataUsuarios.usuarioLecturas;

            const nombresDescargas = usuariosDescargas.map(usuario => usuario.usuarioNombre);
            const descargas = usuariosDescargas.map(usuario => usuario.totalDescargas);

            const nombresLecturas = usuariosLecturas.map(usuario => usuario.usuarioNombre);
            const lecturas = usuariosLecturas.map(usuario => usuario.totalLecturas);


            new Chart(ctxDescargasUsuario, {
                type: 'bar',
                data: {
                    labels: nombresDescargas,
                    datasets: [{
                        label: 'Descargas por Usuario',
                        data: descargas,
                        backgroundColor: 'rgba(93, 18, 80, 0.5)',
                        borderColor: 'rgba(241, 51, 97, 7)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });


            new Chart(ctxLecturasUsuario, {
                type: 'bar',
                data: {
                    labels: nombresLecturas,
                    datasets: [{
                        label: 'Lecturas por Usuario',
                        data: lecturas,
                        backgroundColor: 'rgba(93, 18, 80, 0.5)',
                        borderColor: 'rgba(241, 51, 97, 7)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@stop
