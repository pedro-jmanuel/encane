<?php

namespace App\Http\Requests\Plano;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanoRequest extends FormRequest
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
            'alvo'      => 'required',
            'preco'     => 'required',
            'moeda'     => 'required|max:10',
            'recursos'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required'     => 'O nome é obrigatório',
            'alvo.required'=> 'O alvo é obrigatório',
            'preco.required'     => 'O preço é obrigatório',
            'moeda.required'    => 'A moeda é obrigatória',
            'recursos.required'    => 'O recursos é obrigatório'
        ];
    }}
