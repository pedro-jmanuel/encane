@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Plano /</span> Editar</h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Plano</h5>
        <a href="{{route('plano.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('plano.update',['id' => $plano->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nome</label>
                        <input name="nome" value="{{$plano->nome}}" type="text" class="form-control @error('nome') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('nome')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Alvo</label>
                        <input name="alvo" value="{{$plano->alvo}}" type="text" class="form-control @error('alvo') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('alvo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Preço</label>
                        <input value="{{ $plano->preco }}" name="preco" type="text" class="form-control @error('preco') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('preco')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Moeada</label>
                        <input value="{{$plano->moeda}}" name="moeda" type="text" class="form-control @error('moeda') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
                        @error('moeda')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
            </div>



          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Recursos</label>
            <textarea
              name="recursos"
              id="summernote"
              class="form-control  @error('recursos') is-invalid @enderror"
              placeholder="Escreva ..."
            >
            {!! $plano->recursos !!} </textarea>
            @error('recursos')
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
