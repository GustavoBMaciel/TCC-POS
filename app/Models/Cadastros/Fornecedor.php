<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedor';
    protected $fillable = ['nome', 'rua', 'bairro', 'cidade', 'uf', 'cep', 'fone', 
                           'fax', 'numero', 'compl', 'cgc', 'insc', 'mail', 'obs', 'dtcad'];
}
