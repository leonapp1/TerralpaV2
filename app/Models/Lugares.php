<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugares extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion','img','direccion'];
    public function precios()
    {
        return $this->hasMany(Precios::class)->withPivot('precio');;
    }
}
