<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\Invoice;
use App\Models\Sales\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
    public function store(Request $request)
    {
        //$request->dd();

        $invoice = Invoice::find($request->invoice_id); 
            if ($invoice== NULL)
                return view('errors.404');

        if ($invoice->isFullyPaid()) {
             return redirect()->back()->with("erro", "A factura já foi paga na totalidade.");
        }

        if ($invoice->balance_due < $request->amount) {
             return redirect()->back()->with("erro", "Não pode pagar valor a mais.");
        }

        try {
            DB::beginTransaction();

            $invoice->total_paid  = $invoice->total_paid + $request->amount;
            $invoice->balance_due = $invoice->balance_due - $request->amount;
            
            if ($invoice->isFullyPaid()) {
                $invoice->payment_status = 'PAID';
            } else {
                $invoice->payment_status = 'PARTIALLY_PAID';
            }
            
            $invoice->save();
            
            Payment::create($request->except('_token'));
            DB::commit();
            return redirect()->back()->with("sucesso", "Pagamento salvo com sucesso!");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return redirect()->back()->with("erro", "Ocorreu um erro ao registar o pagamento.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
