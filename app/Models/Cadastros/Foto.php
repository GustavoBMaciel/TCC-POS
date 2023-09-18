<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'fotos';
    protected $fillable = ['codcliente', 'localFoto1', 'obsFoto1', 'localFoto2', 'obsFoto2', 'localFoto3', 'obsFoto3', 'localFoto4', 'obsFoto4', 
                           'localFoto5', 'obsFoto5', 'localFoto6', 'obsFoto6', 'localFoto7', 'obsFoto7', 'localFoto8', 'obsFoto8'];
}