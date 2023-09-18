<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $table = 'acesso';
    protected $fillable = ['Usuario','Senha','codigo','fone','ativo','dataCadastro'];
}
