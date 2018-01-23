<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Usuario;
use Hash;

class UsuarioController extends Controller
{
    public function registrarUsuario(Request $request)
   {
    $crearUsuario = [
      'nombre' => $request->input('nombre'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('password'))
    ];
    if(Usuario::where('email',$crearUsuario['email'])->first() == '')
      {
        $usuario = Usuario::create($crearUsuario);
        $id = $usuario->id;
        return response()->json(compact('id'));
      }
    else
    {
    	return response()->json(['error' => 'El mail ya existe'], 400);
    }
   }
}
