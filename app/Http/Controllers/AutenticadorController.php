<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AutenticadorController extends Controller
{
    public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth', ['except' => ['autentificadorDeUsuario']]);
   }

   public function autentificadorDeUsuario(Request $request)
   {
    	$credencial = $request->only('email', 'password');
    	$token = null;
    	try{
    		if(!$token = JWTAuth::attempt($credencial)){
    			return response()->json(['error' => 'credencial invalida']);
    		}
    	}catch(JWTException $ex){
    		return response()->json(['error' => 'algo anda mal'], 500);
    	}
    	//Si es correccto entonces
        $usuario = JWTAuth::toUser($token);
        $tipo = $usuario->tipo;
        $nombre = $usuario->nombre;
    	return response()->json(compact('token','tipo','nombre'));
    }

    public function verificarUsuario(Request $request)
    {

      $token = JWTAuth::getToken();
      $usuario = JWTAuth::toUser($token);
      //El usuario tiene el permiso ?
      if($usuario->tipo == 'usuario')
      {
        return true;
      }
      else
      {
        return false;
      }

    }

    public function verificarAdministrador(Request $request)
    {
      $token = JWTAuth::getToken();
      $usuario = JWTAuth::toUser($token);
      //El usuario tiene el permiso ?
      if($usuario->tipo == 'administrador')
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    public function validarSession(Request $request)
    {
      $token = JWTAuth::getToken();
      $usuario = JWTAuth::toUser($token);
      // print_r("paso");
      return response(200);
    }

     

}
//Lineas 20