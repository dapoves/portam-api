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

    public function showByCliente($idUser){
        $tarjetas = Tarjeta::where('user_id', $idUser)->get();
        return $tarjetas;
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

    public function setPredeterminada($id){
        $tarjeta = Tarjeta::findOrFail($id);

        // Establecer 'predeterminada' a false en todas las tarjetas del mismo usuario
        Tarjeta::where('user_id', $tarjeta->user_id)
            ->where('id', '!=', $tarjeta->id)
            ->update(['predeterminada' => false]);

        // Establecer 'predeterminada' a true en la tarjeta actual
        $tarjeta->update(['predeterminada' => true]);

        return response()->json([
            'message' => "Tarjeta predeterminada actualizada correctamente",
            'status' => 'ok',
            'tarjeta' => $tarjeta
        ]);
    }

    public function validateTarjeta(){
        return request()->validate([
            'numero' => 'required|digits_between:14,16',
            'user_id' => 'required|exists:users,id',
            'tipo' => 'required|in:visa,mastercard,american_express',
            'titular' => 'required',
            'caducidad' => 'required|date_format:m/y|after_or_equal:today',
            'cvv' => 'required|digits:3',
        ]);
    }

}
