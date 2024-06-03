<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Envio;

class RepartidorController extends Controller
{
    public function repartirEnvio(Request $request){
        $idEnvio = $request->envio_id;
        $idRepartidor = $request->repartidor_id;
        $envio = Envio::findOrFail($idEnvio);
        $envio->update([
            'repartidor_id' => $idRepartidor,
            'estado' => 'aceptado',
            'fechaAceptado' => now(),
        ]);
        return response()->json([
            'message' => "Envio asignado correctamente",
            'status' => 'ok',
            'envio' => $envio
        ]);
    }

    public function getEnviosEnReparto($id){
        $envios = Envio::where('repartidor_id', $id)->whereIn('estado', ['en camino', 'aceptado'])->orderBy('fechaAceptado')->get();
        return $envios;
    }

    public function recogerEnvio($id){
        $envio = Envio::findOrFail($id);
        $envio->update([
            'estado' => 'en camino',
        ]);
        return response()->json([
            'message' => "Envio recogido",
            'status' => 'ok',
            'envio' => $envio
        ]);
    }

    public function entregarEnvio($id){
        $envio = Envio::findOrFail($id);
        $envio->update([
            'estado' => 'entregado',
            'fechaEntrega' => now()
        ]);
        return response()->json([
            'message' => "Envio entregado",
            'status' => 'ok',
            'envio' => $envio
        ]);
    }

    public function cancelarEnvio($id){
        $envio = Envio::findOrFail($id);
        $envio->update([
            'estado' => 'cancelado'
        ]);
        return response()->json([
            'message' => "Envio cancelado",
            'status' => 'ok',
            'envio' => $envio
        ]);
    }

    public function repartirPedido(Request $request){
        $idPedido = $request->pedido_id;
        $idRepartidor = $request->repartidor_id;
        $pedido = Pedido::findOrFail($idPedido);
        $pedido->update([
            'repartidor_id' => $idRepartidor
        ]);
        return response()->json([
            'message' => "Pedido asignado correctamente",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }  

    public function getPedidoEnReparto($id){
        $pedido = Pedido::where('repartidor_id', $id)->whereIn('estado', ['en camino', 'aceptado'])->firstOr(function () {
            return ['message' => 'No tienes ningún pedido asignado'];
        });
        return $pedido;
    }

    public function entregarPedido($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'estado' => 'entregado',
            'fechaEntrega' => now()
        ]);
        return response()->json([
            'message' => "Pedido entregado",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function cancelarPedido($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'estado' => 'cancelado'
        ]);
        return response()->json([
            'message' => "Pedido cancelado",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function getPedidosEntregados($id){
        $pedidos = Pedido::where('repartidor_id', $id)->where('estado', 'entregado')->get();
        return $pedidos;
    }
}
