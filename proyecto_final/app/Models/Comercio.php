<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    protected $fillable = ['idComercio', 'codigo', 'nombre', 'direccion', 'telefono','correo','tipo'];
}
