<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table = 'convenio';
    protected $fillable = ['nome', 'contato', 'fone', 'dtcad', 'ativo', 'desconto', 'lancaCaixa', 'assinatura'];
}
