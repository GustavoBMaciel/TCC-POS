<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    protected $table = 'profissao';
    protected $fillable = ['codigo','nome'];
}
