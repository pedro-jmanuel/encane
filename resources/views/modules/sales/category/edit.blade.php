@extends('administracao.master')
@section('content')

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Categoria</h5>
        <a href="{{route('sales.category.index')}}"><small class="text-muted float-end">Ver todas</small></a>
      </div>
      <div class="card-body">
        @if (session('sucesso'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
        @endif
        <form action="{{route('sales.category.update',["category"=> $category->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="mb-3">
            <label class="form-label" for="name">Nome</label>
            <input value="{{$category->name}}" name="name" type="text" class="form-control  @error('name') is-invalid @enderror" id="basic-default-fullname" placeholder="" />
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

          <div class="mb-3">
            <label class="form-label" for="summernote">Descrição</label>
            <textarea
              name="description"
              id="summernote"
              class="form-control  @error('description') is-invalid @enderror"
              placeholder="Escreva ..."
            >{!! $category->description !!}</textarea>
            @error('description')
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
