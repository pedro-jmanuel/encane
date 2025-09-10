<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Sales\Invoice\StoreInvoiceRequest;
use App\Models\Sales\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

     public $invoice_status = [
        [
            'label' =>'Rascunho',
            'value' =>'DRAFT',
            'help'  =>'Rascunho, ainda não é documento fiscal válido',
            'span_class' =>'badge bg-secondary'
        ],
        [
            'label' =>'Emitida',
            'value' =>'ISSUED',
            'help'  =>'Fatura emitida, aguardando pagamento',
            'span_class' =>'badge bg-warning'
        ],
        [
            'label' =>'Cancelado',
            'value' =>'CANCELLED',
            'help'  =>'Fatura anulada',
            'span_class' =>'badge bg-danger'
        ],
         [
            'label' =>'Não Pago',
            'value' =>'UNPAID',
            'help'  =>'Já devia ter sido pago, mas não foi',
            'span_class' =>'badge bg-dark'
        ],
        [
            'label' =>'Parcialmente paga',
            'value' =>'PARTIALLY_PAID',
            'help'  =>'Parcialmente paga',
            'span_class' =>'badge bg-info'
        ],
        [
            'label' =>'Pago',
            'value' =>'PAID',
            'help'  =>'Totalmente paga',
            'span_class' =>'badge bg-success'
        ]
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["invoices"] = Invoice::paginate(10);
        $data["invoice_status"] = $this->invoice_status;
        return view("modules.sales.invoice.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $data['sales_order_id'] = $request->sales_order_id;
        $data['invoice_date'] = Carbon::now();
        Invoice::create($data);
        return redirect()->back()->with("sucesso", "Factura gerada com sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['invoice'] = Invoice::find($id);
        
        if ($data['invoice'] == NULL)
            return view('errors.404');

        return view("modules.sales.invoice.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
