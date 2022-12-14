<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['idProducto', 'codigo', 'idBase', 'nombre', 'idComercio', 'nombrecomercio', 'precio','precioe', 'fechai', 'fechaf', 'idCategoria', 'ncategoria', 'imagen'];
}
