<?php

namespace App\Http\Requests\Cadastros;

use Illuminate\Foundation\Http\FormRequest;

class AgendaFormRequest extends FormRequest
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
            'nomePaciente'   => 'required|min:3|max:100',
            'data'           => 'required|date',
            'horario'        => 'required',
            'tipo'           => 'required',
            'nomeConvenio'   => 'required',
            'fonePaciente'   => 'required|digits:10|numeric',
            'cdProfissional' => 'required',
            'Status'         => 'required'
        ];
    }
}
