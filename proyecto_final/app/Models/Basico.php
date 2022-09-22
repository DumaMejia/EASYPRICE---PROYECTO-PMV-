<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basico extends Model
{
    protected $fillable = ['idBase', 'codigo', 'nombre', 'precio',  'idCategoria', 'ncategoria'];
}
