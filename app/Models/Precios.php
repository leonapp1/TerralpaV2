<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;
    protected $fillable = ['producto_id','precio','lugar_id'];

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }

    public function lugares()
    {
        return $this->hasMany(Lugares::class,'id');
    }
    public function precios()
    {
        return $this->hasMany(Precios::class);
    }


   
}
