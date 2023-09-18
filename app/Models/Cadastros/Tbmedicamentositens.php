<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Tbmedicamentositens extends Model
{
    protected $table = 'tbmedicamentositens';
    protected $fillable = ['codMedicamentos','codMedicamento', 'concentracao','administracao', 'posologia', 'qtde'];
}