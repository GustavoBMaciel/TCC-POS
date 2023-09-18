<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class TbtipoAgendamento extends Model
{
    protected $table = 'tbtipoagendamento';
    protected $fillable = ['nome', 'cdProfissional'];
}
