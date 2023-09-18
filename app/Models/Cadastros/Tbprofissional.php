<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Tbprofissional extends Model
{
    protected $table = 'tbprofissional';
    protected $fillable = ['dsAtivo', 'dsNomeMedico', 'dsCRM','dsCPF','dsEspecialidade','dsFone','dsCelular','dsCidade','dsUF'];
}
