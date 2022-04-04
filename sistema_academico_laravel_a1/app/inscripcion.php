<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscripcion extends Model
{
    protected $fillable = ['idInscripcion', 'nombre', 'materia1', 'materia2', 'materia3','materia4', 'materia5'];
}
