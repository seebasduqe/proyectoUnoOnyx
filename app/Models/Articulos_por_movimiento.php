<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos_por_movimiento extends Model
{
    use HasFactory;
    protected $table = 'articulos_por_movimientos';
    public $timestamps = false;
}
