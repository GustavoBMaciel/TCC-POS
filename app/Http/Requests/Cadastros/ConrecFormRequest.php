<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class ConrecFormRequest extends FormRequest
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
            'CLIENTE'        => 'required',
            'DATA'           => 'required|date',
            'DTVENC'         => 'required|date',
            'PAGO'           => 'required|min:1|max:1',
            'VALOR'          => 'required',
            'cdProfissional' => 'required',
        ];
    }
}
