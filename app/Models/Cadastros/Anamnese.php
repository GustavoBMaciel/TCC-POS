<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model
{
    protected $table = 'anamneses';
    protected $fillable = ['CodigoPaciente','Questionario','data','cdProfissional'];

}