<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'produto' => 'required|min:2',
            'unidade' => 'required',
            'preco' => 'required',
        ];
    }

    public function messages(){
        return[
            'produto.required' => 'O PRODUTO é obrigatório.',
            'produto.min' => 'O PRODUTO tem que ter pelo menos 2 caracteres.',
            'unidade.required' => 'A UNIDADE é obrigatório.',
            'preco.required' => 'O PREÇO é obrigatório.'
        ];
    }
}
