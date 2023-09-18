<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = 'medicamento';
    protected $fillable = ['nome','concentracao', 'administracao', 'posologia'];
}
