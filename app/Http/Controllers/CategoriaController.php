<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return $categorias;
    }

    public function store(Request $request)
    {
        $categoria = Categoria::create($this->validateCategoria());
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen->store('categorias', 'public');
            $categoria->update([
                'imagen' => $imagen->hashName()
            ]);
        }
        return response()->json([
            'message' => "Categoria creada correctamente",
            'status' => 'ok',
            'categoria' => $categoria
        ]);
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return $categoria;
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $imagen = $request->file('imagen');
        if($imagen){
            $imagen->store('categorias', 'public');
            $categoria->update([
                'imagen' => $imagen->hashName()
            ]);
        }
        
        $array = $request->all();
        foreach ($array as $key => $value) {
            if ($request->filled($key)) {
                $categoria->update([
                    $key => $value
                ]);
            }
        } 
        return response()->json([
            'message' => "Categoria actualizada correctamente",
            'status' => 'ok',
            'categoria' => $categoria
        ]);
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return response()->json([
            'message' => "Categoria eliminada correctamente",
            'status' => 'ok',
            'categoria' => $categoria
        ]);
    }

    public function validateCategoria()
    {
        return request()->validate([
            'nombre' => 'required',
            'imagen' => 'required'
        ]);
    }
}
