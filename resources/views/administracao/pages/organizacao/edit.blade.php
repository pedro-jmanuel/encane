@extends('administracao.master')
@section('content')

<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Ver imagem</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <img loading="lazy" src="{{asset($organizacao->logo)}}" class="img-fluid" alt="post-image">
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

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notícias /</span> Publicar nova</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Organização</h5>
        <a href="{{route('organizacao.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('organizacao.update',["id" =>$organizacao->id ])}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nome</label>
            <input value="{{$organizacao->nome}}" name="nome" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Logotipo</label>
            <input name="logo" class="form-control" type="file" id="formFile" />
          </div>
          <div class="mb-3">
            <button
            type="button"
            class="btn btn-xs btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#exLargeModal"
            >
                Ver Imagem
            </button>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Resumo MetaTags</label>
            <textarea
              name="resumo"
              id="basic-default-message"
              class="form-control"
              placeholder="Escreva ..."
            > {{$organizacao->resumo}}
            </textarea>
          </div>
          <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Telefone 1</label>
                    <input value="{{$organizacao->telefone_1}}" name="telefone_1" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Telefone 2</label>
                    <input value="{{$organizacao->telefone_2}}" name="telefone_2" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">E-mail</label>
                    <input value="{{$organizacao->email}}" name="email" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Endereço</label>
                    <input value="{{$organizacao->endereco}}" name="endereco" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Sobre</label>
            <textarea
              name="sobre"
              id="basic-default-message"
              class="form-control"
              placeholder="Escreva ..."
            >
            {{$organizacao->sobre}}
            </textarea>
          </div>
          <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary">Atualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
