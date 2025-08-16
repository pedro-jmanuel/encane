<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'nome'      => 'required|max:255',
            'descricao' => '',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'descricao'     => '',
        ];
    }
}
