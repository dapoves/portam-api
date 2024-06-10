<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Pedido;
use App\Models\EstablecimientoFavorito;

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

    public function getPedidos(Establecimiento $establecimiento){
        return $establecimiento->pedidos;
    }

    public function getPedidosPendientes(Establecimiento $establecimiento){
        return $establecimiento->pedidos->where('estado', 'pendiente')->values();
    }

    public function getPedidosAceptados(Establecimiento $establecimiento){
        return $establecimiento->pedidos->where('estado', 'aceptado')->sortBy('fechaAceptado')->values();
    }

    public function aceptarPedido($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'estado' => 'aceptado',
            'fechaAceptado' => now()
        ]);
        return response()->json([
            'message' => "Pedido aceptado",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function setPedidoOnTheWay($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'estado' => 'en camino'
        ]);
        return response()->json([
            'message' => "Pedido en camino",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    } 

    public function rechazarPedido($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'estado' => 'cancelado'
        ]);
        return response()->json([
            'message' => "Pedido rechazado",
            'status' => 'ok',
            'pedido' => $pedido
        ]);
    }

    public function addLike(Request $request){
        $id = $request->input('establecimiento_id');
        $idUsuario = $request->input('user_id');
        $establecimiento = Establecimiento::findOrFail($id);
        $establecimiento->update([
            'likes' => $establecimiento->likes + 1
        ]);
        EstablecimientoFavorito::create([
            'establecimiento_id' => $id,
            'user_id' => $idUsuario,
        ]);

        return response()->json([
            'message' => "Like añadido",
            'status' => 'ok',
            'establecimiento' => $establecimiento
        ]);
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
