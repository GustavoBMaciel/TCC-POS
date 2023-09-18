<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Tbexames extends Model
{
    protected $table = 'tbexames';
    protected $fillable = ['codCliente','nome','data','obs','usuario','cdProfissional'];
}
