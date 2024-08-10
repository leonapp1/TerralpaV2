<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }

    public function lugares()
    {
        return $this->belongsToMany(Lugares::class);
    }
}
