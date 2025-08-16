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
                <img loading="lazy" src="{{asset($servico->imagem)}}" class="img-fluid" alt="post-image">
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

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Serviço / </span>Editar</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Serviço</h5>
        <a href="{{route('servico.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('servico.update',[ "id" => $servico->id ])}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Título</label>
            <input value="{{$servico->titulo}}" name="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('titulo')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Imagem de destaque</label>
            <input name="imagem" class="form-control @error('imagem') is-invalid @enderror" type="file" id="formFile" />
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
            <label class="form-label" for="basic-default-message">Conteúdo</label>
            <textarea
              name="conteudo"
              id="basic-default-message"
              class="form-control @error('conteudo') is-invalid @enderror"
              placeholder="Escreva ..."
            >
            {{ $servico->conteudo }}
            </textarea>
            @error('conteudo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary">Publicar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
