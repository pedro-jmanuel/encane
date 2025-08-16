<?php

namespace App\Http\Requests\Servico;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicoRequest extends FormRequest
{ /**
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
           'imagem'   => 'required',
       ];
   }

   public function messages()
   {
       return [
           'titulo.required'  => 'O título é obrigatório',
           'conteudo.required'=> 'O conteúdo é obrigatório',
           'imagem.required'  => 'A imagem é obrigatório',
       ];
   }
}
