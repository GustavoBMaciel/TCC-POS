<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    protected $table = 'exames';
    protected $fillable = ['Nome'];
}
