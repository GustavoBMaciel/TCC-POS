<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Cid10 extends Model
{
    protected $table = 'cid10';
    protected $fillable = ['CID10', 'OPC', 'CAT', 'SUBCAT', 'DESCR', 'RESTRSEXO'];
}
