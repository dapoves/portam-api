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

    public function store(Request $request)
    {
        $establecimiento = Establecimiento::create($this->validateEstablecimiento());
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen->store('establecimientos', 'public');
            $establecimiento->update([
                'imagen' => $imagen->hashName()
            ]);
        }
        return response()->json([
            'message' => "Establecimiento creado correctamente",
            'status' => 'ok',
            'establecimiento' => $establecimiento
        ]);
    }

    public function update(Request $request, $id)
    {
        $establecimiento = Establecimiento::findOrFail($id);

        $imagen = $request->file('imagen');
        if($imagen){
            $imagen->store('establecimientos', 'public');
            $establecimiento->update([
                'imagen' => $imagen->hashName()
            ]);
        }
        
        $array = $request->all();
        foreach ($array as $key => $value) {
            if ($request->filled($key)) {
                $establecimiento->update([
                    $key => $value
                ]);
            }
        } 
        return response()->json([
            'message' => "Establecimiento actualizado correctamente",
            'status' => 'ok',
            'establecimiento' => $establecimiento
        ]);
    }

    public function getProductos(Establecimiento $establecimiento){
        return $establecimiento->productos;
    }

    public function validateEstablecimiento(){
        return request()->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'poblacion_id' => 'required',
            'telefono' => 'required',
            'imagen' => 'required',
            'categoria_id' => 'required',
            'tiempoPreparacion' => 'required',
            'costeEnvio' => 'required'
        ]);
    }
}
