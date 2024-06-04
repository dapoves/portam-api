<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoProducto;

class PedidoProductoController extends Controller
{
    public function index()
    {
        $pedidosProductos = PedidoProducto::all();
        return $pedidosProductos;
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePedidoProducto();
        $validatedData['cantidad'] = $validatedData['cantidad'] ?? 1;
        $existingPedidoProducto = PedidoProducto::where('pedido_id', $validatedData['pedido_id'])
            ->where('producto_id', $validatedData['producto_id'])
            ->first();

        if ($existingPedidoProducto) {
            $existingPedidoProducto->cantidad += $validatedData['cantidad'];
            $existingPedidoProducto->save();

            return response()->json([
                'message' => "Cantidad del producto actualizada correctamente",
                'status' => 'ok',
                'pedidoProducto' => $existingPedidoProducto
            ]);
        }

        $pedidoProducto = PedidoProducto::create($validatedData);

        return response()->json([
            'message' => "Producto añadido al pedido correctamente",
            'status' => 'ok',
            'pedidoProducto' => $pedidoProducto
        ]);
    }

    public function show($id)
    {
        $pedidoProducto = PedidoProducto::findOrFail($id);
        return $pedidoProducto;
    }

    public function update(Request $request, $id)
    {
        $pedidoProducto = PedidoProducto::findOrFail($id);
        $pedidoProducto->update($request->all());
        return response()->json([
            'message' => "Pedido actualizado correctamente",
            'status' => 'ok',
            'pedidoProducto' => $pedidoProducto
        ]);
    }

    public function destroy($id)
    {
        $pedidoProducto = PedidoProducto::findOrFail($id);
        $pedidoProducto->delete();
        return response()->json([
            'message' => "PedidoProducto retirado correctamente",
            'status' => 'ok',
            'pedidoProducto' => $pedidoProducto
        ]);
    }

    public function validatePedidoProducto()
    {
        return request()->validate([
            'pedido_id' => 'required',
            'producto_id' => 'required',
        ]);
    }
}
