<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['idProducto', 'codigo', 'nombre', 'idComercio', 'label','precio','categoria'];
}
