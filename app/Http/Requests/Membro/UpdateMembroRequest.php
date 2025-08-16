<?php

namespace App\Http\Requests\Membro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMembroRequest extends FormRequest
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
            'nome_completo' => 'required|max:255',
            'cargo'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome_completo.required' => 'O nome é obrigatório',
            'cargo.required'         => 'O cargo é obrigatório',
        ];
    }
}
