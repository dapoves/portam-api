<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'contrasenya' => 'required'
        ]);

        if(auth()->attempt($request->only('email', 'contrasenya'))){
            return response()->json([
                'token' => auth()->user()->createToken('token')->plainTextToken,
                'message' => 'Login exitoso'
            ]);
        }

        return response()->json([
            'message' => 'Credenciales incorrectas'
        ], 401);
    }

    public function register(Request $request){
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'contrasenya' => 'required',
            'recontrasenya' => 'required|same:contrasenya'
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'contrasenya' => Hash::make($request->contrasenya),
        ]);

        return response()->json([
            'token' => $user->createToken('token')->plainTextToken,
            'message' => 'Usuario creado correctamente'
        ]);
    }



}
