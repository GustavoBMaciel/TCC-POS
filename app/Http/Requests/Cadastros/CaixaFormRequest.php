<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class CaixaFormRequest extends FormRequest
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
            'Nome_Clifor'      => 'required|min:3|max:100',
            'Data'             => 'required|date',
            'Tipo'             => 'required|min:1|max:1',
            'cdProfissional'   => 'required',
            'Valor'            => 'required'
        ];
    }
}