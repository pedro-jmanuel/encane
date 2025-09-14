@extends('administracao.master')
@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Factura /</span> Ver todas</h4>

<div class="card">
    <h5 class="card-header">Factura </h5>
    <div class="table-responsive text-nowrap ">

      <table class="table table-hover">
        <div class="container  mb-4">
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
            <th>Valor á pagar</th>
            <th>Valor pago</th>
            <th>Valor em falta</th>
            <th>Estado</th>
            <th>Data</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
         @forelse ($invoices as $invoice)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$invoice->id}}</td>
                <td class="text-end"> {{number_format($invoice->order->total_amount, 2, ',', '.')}}</td>
                <td class="text-end"> {{number_format($invoice->total_paid, 2, ',', '.')}}</td>
                <td class="text-end"> {{number_format($invoice->balance_due, 2, ',', '.')}}</td>
                <td>
                  {{-- TODO: Melhorar este forma de acesso, pode ser muito custoso --}}
                  <span
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<span>{{ collect($invoice_status)->firstWhere('value',$invoice->payment_status)['help'] ?? null }}</span>" class="{{ collect($invoice_status)->firstWhere('value',$invoice->payment_status)['span_class'] ?? null }}" >{{ collect($invoice_status)->firstWhere('value',$invoice->payment_status)['label'] ?? null }}</span> </td>
                <td> {{$invoice->invoice_date}}</td>


                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">

                    <a class="dropdown-item" href="{{route('sales.invoice.show',["invoice" => $invoice->id])}}"
                        ><i class="bx bx-receipt me-1"></i> Visualizar</a
                    >
                    {{--        
                      <a class="dropdown-item" href="{{route('sales.invoice.edit',["invoice" => $invoice->id])}}"
                          ><i class="bx bx-edit-alt me-1"></i> Editar</a
                      >
                      <form action="{{ route('sales.invoice.destroy', $invoice->id) }}" 
                            method="POST" 
                            style="display:inline;"
                            >
                          @csrf
                          @method('DELETE')

                          <button type="submit" class="dropdown-item">
                              <i class="bx bx-trash me-1"></i> Eliminar
                          </button>
                      </form>
                    --}}
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
        {{ $invoices->links() }}
    </div>
  </div>

@endsection
