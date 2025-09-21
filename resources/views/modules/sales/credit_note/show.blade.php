@extends('administracao.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Factura /</span> Visualizar Nota de Crédito</h4>


    <div class="row">
        
            <div class="col-lg-12 col-sm-12 col-12">

                <div class="btn-group my-2" id="dropdown-icon-demo">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bx bx-menu"></i> Ações
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('sales.invoice.show', ['invoice' => $invoice->id]) }}">Visualizar Factura</a>
                            <a class="dropdown-item" href="{{ route('sales.credit_note.create', ['order_id' => $invoice->order->id]) }}">Emitir Nota de Crédito</a>
                            <a class="dropdown-item" href="{{ route('sales.credit_note.show', ['credit_note' => 0,'invoice_id' => $invoice->id]) }}">Visualizar Nota de Crédito</a>
                        </li>
                    </ul>
                </div>

            </div>

    </div>
    <div class="row">
         <h2 class="mb-2">Nota de Crédito, Factura #{{$invoice->id}}</h2>
         <div class="row g-2">
            @if ($invoice->hasCreditNote())
                <embed src="{{route('sales.pdf.credit_note',$invoice->id)}}" height="800px" type="application/pdf"> 
            @else
                <div class="alert alert-primary" role="alert">Não foi emitido nota de crédito para esta factura</div>
            @endif
          </div>

    </div>

 
@endsection
