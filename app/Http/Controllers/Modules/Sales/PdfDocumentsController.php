<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfDocumentsController extends Controller
{
    //


    public function invoice_pdf($invoice)
    {
        $data['invoice'] = Invoice::find($invoice);

        //dd($data['invoice']->order->items);
        if ($data['invoice'] == NULL)
            return view('errors.404');

        $pdf = Pdf::loadView('modules.sales.pdf.invoice', $data);

        return $pdf->stream("FACT_".$data['invoice']->id);
    }
    

    public function credit_note_pdf($invoice)
    {
        $data['invoice'] = Invoice::find($invoice);

        $data['credit_note'] = $data['invoice']->creditNotes->first(); // TODO: Será que uma factura pode ter mais de uma nota de credito??


        if ($data['invoice'] == NULL)
            return view('errors.404');

        $pdf = Pdf::loadView('modules.sales.pdf.credit_note', $data);

        return $pdf->stream("CRED_NOTE_".$data['invoice']->id);
    }

}
