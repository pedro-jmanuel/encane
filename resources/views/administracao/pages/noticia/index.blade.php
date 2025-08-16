@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notícias /</span> Ver todas</h4>

<div class="card">
    <h5 class="card-header">Notícias </h5>
    <div class="table-responsive text-nowrap">

      <table class="table table-hover">
        <div class="container">
            @if (session('sucesso'))
                <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{session('sucesso')}}.</div>
            @endif

            @if (session('erro'))
                <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{session('erro')}}.</div>
            @endif
        </div>

        <thead>
          <tr>
            <th>#</th>
            <th>Título</th>
            <th>Data</th>
            <th>Utilizador</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($noticias as $noticia)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{$noticia->titulo}}</td>
                <td>{{ $noticia->data }}</td>
                <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    <li
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar avatar-xs pull-up"
                    title="{{$noticia->autor_nome}} {{$noticia->autor_sobrenome}}"
                    >
                    <img src="{{$noticia->autor_imagem}}" alt="Avatar" class="rounded-circle" />
                    </li>
                </ul>
                </td>

                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('noticia.edit',["id" => $noticia->id])}}"
                        ><i class="bx bx-edit-alt me-1"></i> Editar</a
                    >
                    <a class="dropdown-item" href="{{route('noticia.destroy',["id" => $noticia->id])}}"
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
        {{ $noticias->links() }}
    </div>
  </div>

@endsection
