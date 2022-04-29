<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        //Validar
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        //Verificar credenciales
        $credenciales = request(['email', 'password']);
        if(!Auth::attempt($credenciales)){
            return response()->json(['mensaje' => 'Usuario no autorizado', "error" => true], 401);
        }

        //Generar Token
        $user = $request->user();
        $tokenGenerado = $user->createToken('mi_token_login');
        $token = $tokenGenerado->plainTextToken;

        //Responder Token
        return response()->json(['access_token' => $token, "token_type" => "Bearer", "error" => false], 200);
    }

    public function registro(Request $request){
        //Validar
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        //Guardar
        $us = new User();
        $us->name = $request->name;
        $us->email = $request->email;
        $us->password = bcrypt($request->password);
        $us->save();

        $tokenR = $us->createToken("mi_token");
        $token = $tokenR->plainTextToken;

        //Respuesta
        return response()->json([
            "mensaje" => "registro correcto"
            , "access_token" => $token
        ], 201);
    }

    public function perfil(){
        $us = Auth::user();
        return response()->json($us, 200);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['mensaje' => 'cerrado con exito']);
    }
}
