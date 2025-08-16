@extends('administracao.master')
@section('content')

@foreach($candidatos as $candidato)

<div class="modal fade" id="exLargeModal-{{$candidato->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">{{$candidato->nome_completo}}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">

          <div class="row g-2">
              <embed src="{{asset($candidato->curriculo)}}" height="800px" type="application/pdf">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Fechar
          </button>
        </div>
      </div>
    </div>
  </div>

@endforeach


<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Candidatos para emprego / </span> Ver todos</h4>

<div class="card">
    <h5 class="card-header">Candidatos</h5>
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

        {{-- <div class="container">
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Example select</label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
        </div> --}}

        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Area</th>
            <th>Cv</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($candidatos as $candidato)
            <tr>
                <td>{{$loop->index+ 1 }}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{$candidato->nome_completo}}</td>
                <td>{{ $candidato->email }}</td>
                <td>{{ $candidato->nome }}</td>
                <td>
                    <button
                    type="button"
                    class="btn btn-xs btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#exLargeModal-{{$candidato->id}}"
                  >
                    Ver CV
                  </button>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('candidato.destroy',["id" => $candidato->id])}}"
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
        {{ $candidatos->links() }}
    </div>
  </div>

@endsection
