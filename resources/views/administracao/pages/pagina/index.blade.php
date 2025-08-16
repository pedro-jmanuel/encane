@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pagína / </span> Ver todas</h4>

<div class="card">
    <h5 class="card-header">Pagínas</h5>
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
            <th>Routa</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($paginas as $pagina)
            <tr>
                <td>{{$loop->index+ 1 }}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{$pagina->nome}}</td>
                <td>{{ $pagina->route }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('elemento.create',["pagina_id" =>$pagina->id])}}"
                            ><i class="bx bx-cube-alt me-1"></i>  Criar Elementos</a
                        >
                        <a class="dropdown-item" href="{{route('elemento.edit_all',["pagina_id" =>$pagina->id])}}"
                            ><i class="bx bx-edit-alt me-1"></i> Editar Elementos</a
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
        {{ $paginas->links() }}
    </div>
  </div>

@endsection
