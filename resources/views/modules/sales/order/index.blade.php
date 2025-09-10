@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pedidos /</span> Ver todos</h4>

<div class="card">
    <h5 class="card-header">Pedidos </h5>
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
            <th>Código</th>
            <th>Valor total</th>
            <th>Estado</th>
            <th>Data Vencimento</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($orders as $order)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$order->id}}</td>
                <td class="text-end"> {{$order->total_amount}}</td>
                <td>
                  {{-- TODO: Melhorar este forma de acesso, pode ser muito custoso --}}
                  <span
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<span>{{ collect($order_status)->firstWhere('value',$order->status)['help'] ?? null }}</span>" class="{{ collect($order_status)->firstWhere('value',$order->status)['span_class'] ?? null }}" >{{ collect($order_status)->firstWhere('value',$order->status)['label'] ?? null }}</span> </td>
                <td> {{$order->due_date}}</td>


                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('sales.order.edit',["order" => $order->id])}}"
                        ><i class="bx bx-edit-alt me-1"></i> Editar</a
                    >
                    <form action="{{ route('sales.order.destroy', $order->id) }}" 
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
        {{ $orders->links() }}
    </div>
  </div>

@endsection
