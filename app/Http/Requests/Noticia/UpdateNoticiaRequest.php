<?php

namespace App\Http\Requests\Noticia;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticiaRequest extends FormRequest
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
            'titulo'   => 'required|max:255',
            'conteudo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'  => 'O título é obrigatório',
            'conteudo.required'=> 'O conteúdo é obrigatório',
        ];
    }
}
