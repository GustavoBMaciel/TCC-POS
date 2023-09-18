<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Conrec extends Model
{
    protected $table = 'conrec';
    protected $fillable = ['DATA','DTPAG','DTVENC','LANCA','VALOR','PAGO','CLIENTE','Nome','VL','Valor_Pago','Sn', 'cond', 'cdProfissional'];
}
