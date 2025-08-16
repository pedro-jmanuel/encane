<?php

namespace App\Http\Requests\Parceiro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParceiroRequest extends FormRequest
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
            'link_site' => 'required',
            'sigla'     => 'required|max:10',
            'sobre'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required'     => 'O nome é obrigatório',
            'link_site.required'=> 'O link é obrigatório',
            'sigla.required'    => 'A sigla é obrigatório',
            'sobre.required'    => 'O sobre é obrigatório'
        ];
    }
}
