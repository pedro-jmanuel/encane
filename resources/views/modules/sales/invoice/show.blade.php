@extends('administracao.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Factura /</span> Visualizar</h4>


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
                <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-toggle="modal"
                          data-bs-target="#modalCenter"
                        >
                          Registar Pagamento
                        </button>
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="{{route('sales.payment.store')}}" method="post">
                              {{ csrf_field() }}
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Registar Pagamento</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                


                                </form>
                                <div class="row">
                                  <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                                  <div class="col-12 mb-3">
                                    <label for="amount" class="form-label">Montante</label>
                                    <input
                                      type="number" min="0" value="{{$invoice->balance_due}}"
                                      id="amount"
                                      class="form-control"
                                      placeholder=""
                                      name="amount"
                                    />
                                  </div>
                                  <div class="col-12 mb-3">
                                    <label for="date" class="form-label">Data</label>
                                    <input
                                      name="payment_date"
                                      type="date" 
                                      value="{{ date('Y-m-d') }}"
                                      id="date"
                                      class="form-control"
                                      placeholder=""
                                    />
                                  </div>
                                  <div class="mb-3 col-12">
                                <label for="pay_method" class="form-label">Forma de pagamento</label>
                                <select name="method" class="form-select"
                                    id="pay_method" aria-label="Default select example">
                                    <option value="" selected disabled >Selecione</option>
                                    @foreach ($pay_methods as $pay_method)
                                        <option value="{{$pay_method['value']}}" 
                                        @if ($pay_method['value']=='CASH')
                                            selected
                                        @endif
                                        >{{$pay_method['label']}}</option>     
                                    @endforeach                     
                                </select>
                            </div>
                                </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Fechar
                                </button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                              </div>
                            </div>
                          </div>
                        </div>

            </div>

    </div>
    <div class="row">
         <h2 class="mb-2">Factura #{{$invoice->id}} </h2>
         {{-- TODO: Melhorar este forma de acesso, pode ser muito custoso --}}
                    
         <div class="col-12">
           

            <b>Cliente:</b><span>{{$invoice->order->customer->name}}</span> <br>
            <b>Data:   </b><span>{{$invoice->invoice_date}}</span> <br>
            <b>Estado: </b><span
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<span>{{ collect($invoice_status)->firstWhere('value',$invoice->payment_status)['help'] ?? null }}</span>" class="{{ collect($invoice_status)->firstWhere('value',$invoice->payment_status)['span_class'] ?? null }}" >{{ collect($invoice_status)->firstWhere('value',$invoice->payment_status)['label'] ?? null }}
                    </span> 
            <br>
            <b>Valor Pago: </b> <span> {{number_format($invoice->total_paid, 2, ',', '.')}}Kz</span>
            <br>
            <b>Valor em Falta: </b> <span>{{number_format($invoice->balance_due, 2, ',', '.')}} Kz</span>
            <br>

            @if (session('sucesso'))
                <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('sucesso') }}</div>
            @endif

            @if (session('erro'))
                <div class="alert alert-danger"><i class="bi bi-check-circle"></i> {{ session('erro') }}</div>
            @endif
         </div>

        <div class="row g-2">
              <embed src="{{route('sales.pdf.invoice',$invoice->id)}}" height="800px" type="application/pdf">
          </div>

    </div>

 
@endsection
