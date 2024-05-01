<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    public function index(){
        return Tarjeta::all();
    }

    public function store(Request $request){
        $tarjeta = Tarjeta::create($this->validateTarjeta());
        return response()->json([
            'message' => "Tarjeta creada correctamente",
            'status' => 'ok',
            'tarjeta' => $tarjeta
        ]);
    }

    public function show($id){
        $tarjeta = Tarjeta::findOrFail($id);
        return $tarjeta;
    }

    public function showByCliente(){
        return auth()->user()->tarjetas;
    }

    public function destroy($id){
        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->delete();
        return response()->json([
            'message' => "Tarjeta retirada correctamente",
            'status' => 'ok',
            'tarjeta' => $tarjeta
        ]);
    }

    public function update(Request $request, $id){
        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->update($request->all());
        return response()->json([
            'message' => "Tarjeta actualizada correctamente",
            'status' => 'ok',
            'tarjeta' => $tarjeta
        ]);
    }

    public function validateTarjeta(){
        return array_merge(request()->validate([
            'numero' => 'required',
            'tipo' => 'required',
            'titular' => 'required',
            'caducidad' => 'required',
            'cvv' => 'required',
        ]), [
            'user_id' =>  auth()->user()->id,
        ]);
    }
}
