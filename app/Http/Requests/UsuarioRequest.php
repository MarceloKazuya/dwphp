<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest {
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
            'nome' => 'required|min:2',
            'password' => 'required|max:6',
            'nivel' => 'required'
        ];
    }

    public function messages(){
        return[
            'nome.required' => 'O NOME é obrigatório.',
            'nome.min' => 'O NOME tem que ter pelo menos 2 caracteres.',
            'password.required' => 'A PASSWORD é obrigatório.',
            'nivel.required' => 'O NÍVEL é obrigatório.'
        ];
    }
}
