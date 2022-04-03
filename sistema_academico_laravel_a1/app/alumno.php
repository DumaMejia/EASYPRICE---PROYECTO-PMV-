<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alumnado extends Model
{
    protected $fillable = ['idAlumno', 'codigo', 'nombre', 'direccion', 'telefono','dui'];
}
