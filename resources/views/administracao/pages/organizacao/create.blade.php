@extends('administracao.master')
@section('content')

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
        <form action="{{route('organizacao.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nome</label>
            <input name="nome" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Logotipo</label>
            <input name="logo" class="form-control" type="file" id="formFile" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Resumo MetaTags</label>
            <textarea
              name="resumo"
              id="basic-default-message"
              class="form-control"
              placeholder="Escreva ..."
            ></textarea>
          </div>
          <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Telefone 1</label>
                    <input name="telefone_1" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Telefone 2</label>
                    <input name="telefone_2" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">E-mail</label>
                    <input name="email" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                  </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Endereço</label>
                    <input name="endereco" type="text" class="form-control" id="basic-default-fullname" placeholder="" />
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
            ></textarea>
          </div>

          <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary @if ($disable_btn) disabled @endif">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
