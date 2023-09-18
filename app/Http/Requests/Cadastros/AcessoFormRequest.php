<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class AcessoFormRequest extends FormRequest
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
            'name'         => 'required|min:3|max:100',
            'password'     => 'required|min:4|max:100',
            'fone'         => 'required|min:10|max:11',
            'ativo'        => 'required',
            'dataCadastro' => 'required|date'
        ];
    }
}
