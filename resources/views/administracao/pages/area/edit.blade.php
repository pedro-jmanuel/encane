@extends('administracao.master')
@section('content')

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Área</h5>
        <a href="{{route('area.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('area.update',["id"=> $area->id])}}" method="POST" enctype="multipart/form-data">

            @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nomw</label>
            <input value="{{$area->nome}}" name="nome" type="text" class="form-control  @error('nome') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('nome')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-message">Descrição</label>
            <textarea
              name="descricao"
              id="summernote"
              class="form-control  @error('descricao') is-invalid @enderror"
              placeholder="Escreva ..."
            >{!! $area->descricao !!}</textarea>
            @error('descricao')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button type="submit" style="background-color: #005657; border-color: #005657;" class="btn btn-primary">Atualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
