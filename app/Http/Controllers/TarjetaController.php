<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    public function index(){
        return Tarjeta::all();
    }
}
