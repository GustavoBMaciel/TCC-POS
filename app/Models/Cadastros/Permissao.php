<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissao';
    protected $fillable = ['descricaobusca','descricaotela', 'grupo','cdgrupopermissao'];
}