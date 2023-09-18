<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            'nome'             => 'required|min:3|max:100',
            'dtcad'            => 'required|date',
            'dtnasc'           => 'required|date',
            'Responsavel'      => 'max:100',
            'rua'              => 'required|min:3|max:100',
            'numero'           => 'required|min:1|max:100',
            'compl'            => 'max:100',
            'Bairro'           => 'required|min:3|max:100',
            'CEP'              => 'required|min:3|max:100',
            'Cidade'           => 'required|min:3|max:100',
            'uf'               => 'required|min:2|max:2',
            'fone'             => 'required|digits:10|numeric',
            'celular'          => 'required|digits:11|numeric',
            'Obs'              => 'max:1000',
            'ativo'            => 'required',
            'Sexo'             => 'required',
            'convenio'         => 'required',
            'tipo'             => 'required',
            'foto'             => 'image|mimes:jpeg|max:2048|',
            'profissao'        => 'required',
            'dsEmail'          => 'required|email|min:3|max:100',
            'dsCPF'            => 'required|numeric|digits:11',
            'dsCartaoConvenio' => 'max:100'
        ];
    }
}
