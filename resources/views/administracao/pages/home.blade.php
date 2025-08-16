@extends('administracao.master')
@section('content')
<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">PRÉ - VISUALIZAR WEBSITE</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">

          <div class="row g-2">
              <embed src="{{route('index')}}" height="800px" type="application/pdf">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Fechar
          </button>
        </div>
      </div>
    </div>
  </div>

<div class="container">
<div class="row">
    <div class="col-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Olá, {{auth()->user()->nome}} {{auth()->user()->sobrenome}} ! 😃 </h5>
                <p class="mb-4 text-primary" style="">
                    {{$frase}}
                </p>

              <a href="{{route('index')}}" target="_blank" class="btn btn-sm btn-outline-primary">VER WEBSITE</a>
              <a href="{{route('index')}}" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="btn btn-sm btn-outline-primary">PRÉ - VISUALIZAR WEBSITE</a>
              <a href="{{route('index')}}/webmail" target="_blank" class="btn btn-sm btn-outline-primary">ENTRAR NO WEBMAIL</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="{{asset('assets/administracao/img/illustrations/man-with-laptop-light.png')}}"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>


  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12  mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img
                  src="{{asset('assets/administracao/img/icons/unicons/chart-success.png')}}"
                  alt="chart success"
                  class="rounded"
                />
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt3"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="{{route('servico.solicitacoes')}}">Ver mais</a>

                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Serviços atendido</span>
            <h3 class="card-title mb-2">{{$totalAtendido}}</h3>
            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img
                  src="{{asset('assets/administracao/img/icons/unicons/wallet-info.png')}}"
                  alt="Credit Card"
                  class="rounded"
                />
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt6"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="{{route('servico.index')}}">Ver mais</a>

                </div>
              </div>
            </div>
            <span>Serviços desponíveis</span>
            <h3 class="card-title text-nowrap mb-1">{{$totalServicos}}</h3>
            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i></small> --}}
          </div>
        </div>
      </div>
        <div class="col-md-3 col-sm-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="{{asset('assets/administracao/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded" />
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item"  href="javascript:void(0);">Ver mais</a>
                  </div>
                </div>
              </div>
              <span class="d-block mb-1">Utilizadores</span>
              <h3 class="card-title text-nowrap mb-2">{{$totalUtilizadores}}</h3>
              {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i></small> --}}
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="{{asset('assets/administracao/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded" />
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt1"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                    <a class="dropdown-item" href="{{route('noticia.index')}}">Ver mais</a>

                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Notícias</span>
              <h3 class="card-title mb-2">{{$totalNoticias}}</h3>
              {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i></small> --}}
            </div>
          </div>
        </div>
    </div>
  </div>

@endsection
