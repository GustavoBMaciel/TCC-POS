<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    protected $table = 'caixa';
    protected $fillable = ['Data','Tipo','Valor','Cod_Clifor','Nome_Clifor','Sn','Venda','Ent_Ven','cdProfissional'];
}
