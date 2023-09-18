<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $fillable = ['codcli','data','horario','realizado','tipo','nomePaciente','nomeConvenio','fonePaciente','valor','formaPagto','hrSalaEspera','cdProfissional'];
}
