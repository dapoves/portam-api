<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'status' => 'ok',
                'user' => [
                    'nombre' => $user->nombre,
                    'id' => $user->id,
                    'email' => $user->email,
                    'rol' => $user->rol]
            ]);
        }

        return response()->json([
            'message' => 'Credenciales incorrectas'
        ], 401);
    }

    public function register(Request $request){
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'telefono' => 'nullable|numeric|digits:9',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        Auth::attempt($credentials);

        return response()->json([
            'accessToken' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
            'message' => 'User creado correctamente',
            'status' => 'ok',
            'user' => [
                'nombre' => $user->nombre,
                'email' => $user->email,
                'rol' => $user->rol,
                'id' => $user->id]
        ]);
    }

    public function logout(Request $request){
        $request->session()->flush();
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Has cerrado sesión y el token ha sido eliminado',
            'status' => 'ok'
        ];
    }

}
