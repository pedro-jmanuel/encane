@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Artigo /</span> Ver todas</h4>

<div class="card">
    <h5 class="card-header">Artigo </h5>
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
            <th>Nome</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($items as $item)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{$item->name}}</td>
                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('sales.item.edit',["item" => $item->id])}}"
                        ><i class="bx bx-edit-alt me-1"></i> Editar</a
                    >
                    <form action="{{ route('sales.item.destroy', $item->id) }}" 
                          method="POST" 
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="dropdown-item">
                            <i class="bx bx-trash me-1"></i> Eliminar
                        </button>
                    </form>
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
        {{ $items->links() }}
    </div>
  </div>

@endsection
