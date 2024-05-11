<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poblacion;

class PoblacionController extends Controller
{
    public function index()
    {
        $poblaciones = Poblacion::all();
        return $poblaciones;
    }

    public function show(Poblacion $poblacion)
    {
        return $poblacion;
        // $producto = Producto::findOrFail($id);
        // return $producto;
    }
}
