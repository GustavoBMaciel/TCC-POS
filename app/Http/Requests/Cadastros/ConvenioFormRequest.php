<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class ConvenioFormRequest extends FormRequest
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
            'nome'       => 'required|min:3|max:100',
            'contato'    => 'required|min:3|max:100',
            'fone'       => 'required|digits:10|numeric',
            'dtcad'      => 'required|date',
            'desconto'   => 'required|min:1|max:100|numeric',
            'lancaCaixa' => 'required|min:1|max:1'
        ];
    }
}
