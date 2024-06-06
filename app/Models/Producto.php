<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_producto')->withPivot('cantidad');
    }
}
