<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Envio;

class EnvioController extends Controller
{
    public function index(){
        $envios = Envio::all();
        return $envios;
    }

    public function show($id){
        $envio = Envio::findOrFail($id);
        return $envio;
    }

    public function showByCliente($id){
        $envios = Envio::where('cliente_id', $id)->get();
        return $envios;
    }

    public function store(Request $request){
        $envio = Envio::create($this->validateEnvio());
        return response()->json([
            'message' => "Pedido creado correctamente",
            'status' => 'ok',
            'pedido' => $envio
        ]);
    }

    public function validateEnvio(){
    
        return array_merge(request()->validate([
            'origen_id' => 'required',
            'cliente_id' => 'required',
            'origen_id' => 'required',
            'destino_id' => 'required',
            'indicaciones' => 'nullable',
            'tarjeta_id' => 'required',
            'precioTotal' => 'required',
            'tipo' => 'required|in:ligero,pesado',
            'peso' => 'required',
            'espera' => 'required|in:mes,semana,manyana,hoy,antes posible',
            'descripcion' => 'required',
            'direccionRecogida' => 'required',
            'direccionEntrega' => 'required',
        ]), [
            'fechaPedido' => date('Y-m-d H:i:s'),
        ]);
    }

    
}
