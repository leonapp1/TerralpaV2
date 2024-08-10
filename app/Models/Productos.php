<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'Unid',
        'peso',
        'cantidad',
        'img'
    ];

    public function precios()
    {
        return $this->hasMany(Precios::class,'producto_id');
    }

    public function lugares()
    {
        return $this->hasMany(Precios::class,'producto_id');
    }
}
