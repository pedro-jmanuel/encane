<?php

namespace App\Http\Requests\Modules\Sales\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sales_order_id'=> 'required|unique:sales_invoices',
        ];
    }

    public function messages()
    {
        return [
            'sales_order_id.unique' => 'Já foi gerado uma Factura para esse pedido.',
        ];
    }
}
