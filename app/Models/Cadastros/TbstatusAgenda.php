<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class TbstatusAgenda extends Model
{
    protected $table = 'tbstatusagenda';
    protected $fillable = ['nome', 'dsSimbolo', 'dsCor'];
}
