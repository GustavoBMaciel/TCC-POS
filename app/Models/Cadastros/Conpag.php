<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Conpag extends Model
{
    protected $table = 'conpag';
    protected $fillable = ['DATA','DTPAG','DTVENC','CODFOR','Nome','PAGO','VALOR','Lanca','Valor_Pago','cdProfissional'];
}
