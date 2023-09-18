<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class ProfissionalFormRequest extends FormRequest
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
            'dsAtivo'         => 'required|min:1|max:1',
            'dsNomeMedico'    => 'required|min:3|max:100',
            'dsCRM'           => 'required|numeric|min:5',
            'dsCPF'           => 'required|numeric|digits:11',
            'dsEspecialidade' => 'required|min:3|max:100',
            'dsCidade'        => 'required|min:3|max:100',
            'dsUF'            => 'required|min:2|max:2',
            'dsFone'          => 'required|digits:10|numeric',
            'dsCelular'       => 'required|digits:11|numeric'
        ];
    }
}
