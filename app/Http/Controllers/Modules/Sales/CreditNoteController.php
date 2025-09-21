<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\CreditNote;
use App\Models\Sales\CreditNoteItem;
use App\Models\Sales\Invoice;
use App\Models\Sales\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['order'] = Order::find($request->order_id);
        $data['order_status'] = new Collection(Order::status());

        if ($data['order'] == NULL)
            return view('errors.404');

        return view("modules.sales.credit_note.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->dd();
        $data['order'] = Order::find($request->order);
       
        if ($data['order'] == NULL)
            return view('errors.404');

        try {

            DB::beginTransaction();

            
            $creditNote = CreditNote::create([
                "sales_invoice_id"=> $request->invoice,
                "date"            => Carbon::now(),
                "reason"          => $request->reason,
                "status"          => $request->order_id ?? 'ISSUID',
                "total_amount"    => 0
            ]);
 
            
            $total = 0;
            foreach ($request->order_items as $key => $order_item) {
                if ($order_item['return_quantity'] != null and $order_item['return_quantity'] > 0 ) {
                    CreditNoteItem::create([
                    "sales_credit_note_id" => $creditNote->id,
                    "sales_item_id"        => $order_item['sales_item_id'],
                    "purchase_tax"         => $order_item['purchase_tax'] ?? 0, //TODO: Deve ser revito pois ainda não está a ser usado
                    "sales_tax"            => $order_item['sales_tax'],
                    "quantity"             => $order_item['return_quantity'],
                    "unit_price"           => $order_item['unit_price'],
                    "discount"             => $order_item['discount'] ?? 0,
                    "subtotal"             => $order_item['return_subtotal']
                  ]);
                   $total += $order_item['return_subtotal'];
                }
              
            }
            $creditNote->total_amount = $total;
            $creditNote->save();
            //dd($creditNote);
            DB::commit();
            return redirect()->back()->with("sucesso", "Nota de crédito salvo com sucesso ");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return redirect()->back()->with("erro", "Ocorreu algum erro ao salvar a nota de crédito.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $data['invoice'] = Invoice::find($request->invoice_id);
        
        if ($data['invoice'] == NULL)
            return view('errors.404');

        return view("modules.sales.credit_note.show",$data); 
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
