<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return $productos;
    }

    public function store(Request $request)
    {
        $producto = Producto::create($this->validateProducto());
        return response()->json([
            'message' => "Producto creado correctamente",
            'status' => 'ok',
            'producto' => $producto
        ]);
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return $producto;
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $imagen = $request->file('imagen');
        if($imagen){
            $imagen->store('productos', 'public');
            $producto->update([
                'imagen' => $imagen->hashName()
            ]);
        }

        $producto->update($request->all());
        return response()->json([
            'message' => "Producto actualizado correctamente",
            'status' => 'ok',
            'producto' => $producto
        ]);
    }
    

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json([
            'message' => "Producto retirado correctamente",
            'status' => 'ok',
            'producto' => $producto
        ]);
    }

    public function validateProducto()
    {
        return request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'precio' => 'required',
            'establecimiento_id' => 'required',
            'tamano' => 'required|in:pequeno,mediano,grande',
        ]);
    }
}