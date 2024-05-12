<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function poblacion()
    {
        return $this->belongsTo(Poblacion::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
