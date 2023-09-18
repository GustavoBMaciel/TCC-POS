<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nome'   => 'required|min:3|max:100',
            'rua'    => 'required|min:3|max:100',
            'bairro' => 'required|min:3|max:100',
            'cidade' => 'required|min:3|max:100',
            'uf'     => 'required|min:2|max:2',
            'cep'    => 'required|min:3|max:100',
            'fone'   => 'required|digits:10|numeric',
            'fax'    => 'required|digits:11|numeric',
            'numero' => 'required|min:1|max:100',
            'compl'  => 'max:100',
            'cgc'    => 'required|min:11|max:14',
            'insc'   => 'required|min:8|max:10',
            'mail'   => 'required|email|min:3|max:100',
            'obs'    => 'max:1000',
            'dtcad'  => 'required|date'
        ];
    }
}

