@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notícias /</span> Publicar nova</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Notícia</h5>
        <a href="{{route('noticia.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('noticia.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Título</label>
            <input name="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('titulo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Imagem de destaque</label>
            <input name="imagem" class="form-control @error('imagem') is-invalid @enderror" type="file" id="formFile" />
            @error('imagem')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Conteúdo</label>
            <textarea
              name="conteudo"
              id="summernote"
              class="form-control  @error('conteudo') is-invalid @enderror"
              placeholder="Escreva ..."
            ></textarea>
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
