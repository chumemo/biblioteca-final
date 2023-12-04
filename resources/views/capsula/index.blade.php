@extends('layouts.base')
@section('content')
@section('titulo_seccion', 'CAPSULAS INFORMATIVAS')

    <div class="container mt-4">

        <div class="row">

            @forelse ($capsulas as $capsula)
                <div class="col-lg-3 col-md-6 mb-4 cardEffect">
                    <a href="" data-bs-toggle="modal" data-bs-target="#miModal" class="text-decoration-none ">
                        <div class="card align-items-center border-0 " style="width: 100%;">
                            <img src="{{ $capsula->urlImagen }}" class="" alt="Capsula thumbnail" width="200px"
                            height="200px">
                            <h6 class="limitedText text-secondary mt-2 mb-0 "> {{ $capsula->titulo }}</h6>
                            <p class="text-secondary fs-xxsm text-decoration-none ">{{ $capsula->fecha }}</p>
                            <span id="url" hidden>{{ $capsula->url }}</span>
                            <p id="capsulaDescription" hidden>{{ $capsula->descripcion }}</p>
                        </div>
                    </a>
                </div>

                
                @empty
                <h4>NINGUN CAPSULA POR MOSTRAR</h4>
                @endforelse
        </div>
        @section('pagination')
        {{ $capsulas->links('pagination::simple-bootstrap-5') }}
        @endsection

    </div>
    

    <!-- Modal -->
    <div class="modal fade " id="miModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content p-0 m-0">
                <div class="modal-body p-0 m-0">


                    <div>
                        <iframe width="100%" height="400px"
                            id="videoIframe"
                            src="" title=""
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <h5 class="gothamB text-secondary px-4 " id="modalTitle"></h5>
                    <hr>
                    <p class="fs-6 px-4 text-secondary " id="modalDescription"></p>



                </div>
            </div>
        </div>
    </div>

    <script>
        let cards = document.querySelectorAll('.card');
        cards.forEach( card => {
             let link = card.parentElement;
             link.addEventListener('click', (e) => {
                e.preventDefault();
                 let url = card.querySelector('#url').textContent;

                 let iframe = document.querySelector('iframe');
                 iframe.src = url;
                 let modalTitle = document.querySelector('#modalTitle');
                 modalTitle.textContent = card.querySelector('h6').textContent;

                 let modalDescription = document.querySelector('#modalDescription');
                 modalDescription.innerHTML = link.querySelector('#capsulaDescription').textContent;
             });
         });
        

        let videoIframe = document.getElementById("videoIframe");
        
        document.getElementById("miModal").addEventListener('hidden.bs.modal', function() {
            
            if (videoIframe !== null) {
                var videoSrc = videoIframe.src;
                videoIframe.src = "";
                videoIframe.src = videoSrc;
            }
        });
     </script>
@endsection
