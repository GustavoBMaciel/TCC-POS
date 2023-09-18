<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentoFormRequest extends FormRequest
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
            'nomeGenerico'  => 'required|min:3|max:100',
            'nomeFabrica'   => 'required|min:3|max:100',
            'fabricante'    => 'required|min:3|max:100',
            'concentracao'  => 'required|min:3|max:100',
            'administracao' => 'required',
            'posologia'     => 'required|max:150'
        ];
    }
}