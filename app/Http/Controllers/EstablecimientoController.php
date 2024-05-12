<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;

class EstablecimientoController extends Controller
{
    public function index()
    {
        $establecimientos = Establecimiento::all();
        return $establecimientos;
    }

    public function show(Establecimiento $establecimiento)
    {
        return $establecimiento;
    }

    public function getProductos(Establecimiento $establecimiento)
    {
        return $establecimiento->productos;
    }
}
