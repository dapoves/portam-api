<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstablecimientoFavorito extends Model
{
    use HasFactory;

    protected $fillable = ['establecimiento_id', 'user_id'];

    protected $table = 'favoritos_establecimiento_user';

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
