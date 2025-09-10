@extends('administracao.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Factura /</span> Visualizar</h4>


    <div class="row">
        
         <div class="row g-2">
              <embed src="{{route('sales.pdf.invoice',$invoice->id)}}" height="800px" type="application/pdf">
          </div>

    </div>

 
@endsection
