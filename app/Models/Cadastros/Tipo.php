<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipo';
    protected $fillable = ['nome'];
}
