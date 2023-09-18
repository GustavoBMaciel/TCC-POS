<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Tbmedicamentos extends Model
{
    protected $table = 'tbmedicamentos';
    protected $fillable = ['codCliente','data','obs','usuario','cdProfissional'];
}
