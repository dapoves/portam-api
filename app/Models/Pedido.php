<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function repartidor()
    {
        return $this->belongsTo(Usuario::class);
    }
}
