<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $fillable = ['nome', 'dtcad', 'dtnasc', 'Responsavel', 
                           'rua', 'numero', 'compl', 'Bairro', 'CEP', 'Cidade', 'uf', 
                           'fone', 'celular', 'Obs', 'ativo', 'sexo', 'convenio', 'tipo', 
                           'foto', 'profissao', 'dsEmail', 'dsCPF', 'dsCartaoConvenio'];
}
