@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Organização / </span> Ver todas</h4>

<div class="card">
    <h5 class="card-header">Organização</h5>
    <div class="table-responsive text-nowrap">

      <table class="table table-hover">
        <div class="container">
            @if (session('sucesso'))
                <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}</div>
            @endif

            @if (session('erro'))
                <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
            @endif
        </div>

        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone 1</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($organizacoes as $organizacao)
            <tr>
                <td>{{$loop->index+ 1 }}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{$organizacao->nome}}</td>
                <td>{{ $organizacao->email }}</td>
                <td>{{ $organizacao->telefone_1 }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('organizacao.edit',["id" => $organizacao->id ])}}"
                            ><i class="bx bx-edit-alt me-1"></i> Editar</a
                        >
                        <a class="dropdown-item" href="{{route('organizacao.destroy',["id" => $organizacao->id ])}}"
                            ><i class="bx bx-trash me-1"></i> Eliminar</a
                        >
                        </div>
                    </div>
                </td>
            </tr>
         @empty

         @endforelse
            <br><br><br>

        </tbody>
      </table>
    </div>
    <div class="container my-3">
        {{ $organizacoes->links() }}
    </div>
  </div>

@endsection
