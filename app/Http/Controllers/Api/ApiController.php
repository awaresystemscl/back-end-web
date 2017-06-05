<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AutenticadorController;
use App\Modelos\Api;

class ApiController extends Controller
{
  public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['']]);
   }

    public function verApi(Request $request)
  {

      $verficiar =  new AutenticadorController();
      if($verficiar->verificarUsuario($request))
      {
        $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
        $api = Api::where('id',$request->input('id'))->first();
        return response()->json(compact('api','usuarioID'));
      }
      else
      {
        return response()->json(['Error' => 'Permiso Denegado']);
      }
	    
  }

  public function verNombreDeApiLocal($nombre)
  {
        $api = Api::where('nombre',$nombre)->first();
        return $api;
	    
  }

  public function crearApi(Request $request)
  {
        $crearApi = [
			'nombre' => $request->input('nombre'),
			'descripcion' => $request->input('descripcion'),
			'url' => $request->input('url'),
        ];
        $api = Api::create($crearApi);
        $id = $api->id;
        return response()->json(compact('id'));
	    
  }

  public function crearApiLocal($request)
  {
        $crearApi = [
    			'nombre' => $request['nombre'],
    			'descripcion' => $request['descripcion'],
    			'url' => $request['url'],
        ];
        $api = Api::create($crearApi);
        $id = $api->id;
        return $id;
	    
  }
}
//Lineas 28