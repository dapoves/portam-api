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

    public function store(Request $request){
        $envio = Envio::create($this->validateEnvio());
        return response()->json([
            'message' => "Pedido creado correctamente",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function validatePedido(){
    
        return array_merge(request()->validate([
            'origen_id' => 'required',
            'cliente_id' => 'required',
            'origen_id' => 'required',
            'destino_id' => 'required',
            'tarjeta_id' => 'required',
            'precioTotal' => 'required',
            'tipo' => 'required|in:ligero,pesado',
            'peso' => 'required',
            'espera' => 'required|in:Este mes,Esta semana,Hoy,Lo antes posible',
            'estado' => 'required|in:pendiente,aceptado,en camino,entregado,cancelado',
            'indicaciones' => 'required'
        ]), [
            'fechaPedido' => date('Y-m-d H:i:s'),
        ]);
    }

    
}
