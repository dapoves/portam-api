<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;


class PedidoController extends Controller
{

    public function index(){
        $pedidos = Pedido::all();
        return $pedidos;
    }

    public function store(Request $request){
        $pedido = Pedido::create($this->validatePedido());
        return response()->json([
            'message' => "Pedido creado correctamente",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function show($id){
        $pedido = Pedido::findOrFail($id);
        return $pedido;
    }

    public function update(Request $request, $id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return response()->json([
            'message' => "Pedido actualizado correctamente",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function destroy($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
        return response()->json([
            'message' => "Pedido retirado correctamente",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function validatePedido(){
    
        return array_merge(request()->validate([
            'cliente_id' => 'required',
            'establecimiento_id' => 'required',
            'tarjeta_id' => 'required',
            'precioTotal' => 'required',
            'indicaciones' => 'required',
            'direccion' => 'required'
        ]), [
            'fechaPedido' => date('Y-m-d H:i:s'),
        ]);
    }
}
