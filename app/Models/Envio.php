<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function cliente()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function repartidor()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function poblacionOrigen()
    {
        return $this->belongsTo(Poblacion::class);
    }

    public function poblacionDestino()
    {
        return $this->belongsTo(Poblacion::class);
    }

    public function tarjeta()
    {
        return $this->belongsTo(Tarjeta::class);
    }

}
