@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Serviço / </span>Solicitações</h4>

@forelse ($solicitacoes as $solicitacao)

<div class="modal fade" id="basicModal-{{$solicitacao->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Serviço : {{$solicitacao->titulo_servico}}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">

            <div class="card shadow-none bg-transparent border border-primary mb-3">
                <div class="card-body">
                  <p class="card-text"> {{$solicitacao->mensagem}}</p>
                </div>
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
  @empty

  @endforelse

<div class="card">
    <h5 class="card-header">Solicitações de Serviço</h5>
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
            <th>Nome Completo</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Atendido</th>
            <th>Mensagem</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($solicitacoes as $solicitacao)
            <tr>
                <td>{{$loop->index+ 1 }}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{$solicitacao->nome_completo}}</td>
                <td>{{$solicitacao->telefone }}</td>
                <td>{{$solicitacao->email }}</td>
                <td>
                    @if ($solicitacao->is_atendido)
                        <a href="{{route("solicitacao.atendimento",["id" => $solicitacao->id])}}"> <span class="badge bg-primary"> Sim</span></a>
                    @else
                        <a href="{{route("solicitacao.atendimento",["id" => $solicitacao->id])}}">  <span class="badge bg-danger">Não</span></a>
                    @endif
                </td>
                <td>
                        <button
                          type="button"
                          class="badge bg-dark"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal-{{$solicitacao->id}}"
                        >
                        Ler
                        </button>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('solicitacao.destroy',["id" => $solicitacao->id])}}"
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
        {{ $solicitacoes->links() }}
    </div>
  </div>

@endsection
