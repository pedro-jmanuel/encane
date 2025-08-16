@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Associado /</span>  Registrar novo</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Associado</h5>
        <a href="{{route('parceiro.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('parceiro.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nome</label>
            <input name="nome" type="text" class="form-control @error('nome') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('nome')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Sigla</label>
            <input name="sigla" type="text" class="form-control @error('sigla') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('sigla')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Logotipo</label>
            <input name="logo" class="form-control @error('logo') is-invalid @enderror" type="file" id="formFile" />
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Link</label>
            <input name="link_site" type="url" class="form-control @error('link_site') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('link_site')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Sobre</label>
            <textarea
              name="sobre"
              id="basic-default-message"
              class="form-control @error('sobre') is-invalid @enderror"
              placeholder="Escreva ..."
            ></textarea>
            @error('sobre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
