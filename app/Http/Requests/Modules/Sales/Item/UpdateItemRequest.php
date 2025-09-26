<?php

namespace App\Http\Requests\Modules\Sales\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name'  => 'required|max:255',
            'price' => 'required|max:255',
            'item_type'  => 'required|max:255',
            'category_id'=> 'required|max:255',
            'description' => '',
            'sales_tax_id'=> 'required',
            'purchase_tax_id'=> 'required',
            'cost'=>''
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'price.required' => 'O preço é obrigatório',
            'item_type.required' => 'O tipo é obrigatório',
            'category_id.required'=> 'A categoria é obrigatorio',
            'description' => '',
            'sales_tax_id'=> 'O imposto de venda é obrigatorio',
            'purchase_tax_id'=> 'O imposto de compra é obrigatorio',
            'cost'=>''
        ];
    }
}
