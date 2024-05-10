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
                'token' => $token,
                'status' => 'ok',
                'user' => [
                    'nombre' => $user->nombre,
                    'email' => $user->email ]
            ]);
        }

        return response()->json([
            'message' => 'Credenciales incorrectas'
        ], 401);
    }

    public function register(Request $request){ //probar el valiate
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'repassword' => 'required|same:password'
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
            'token' => $user->createToken('token')->plainTextToken,
            'message' => 'User creado correctamente',
            'status' => 'ok',
            'user' => [
                'nombre' => $user->nombre,
                'email' => $user->email ]
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
