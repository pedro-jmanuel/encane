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
            'tax_rate'   => 'required|max:255',
            'item_type'  => 'required|max:255',
            'description' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'price.required' => 'O preço é obrigatório',
            'tax_rate.required' => 'A taxa de imposto é obrigatório',
            'item_type.required' => 'O tipo é obrigatório',
            'description'     => '',
        ];
    }
}
