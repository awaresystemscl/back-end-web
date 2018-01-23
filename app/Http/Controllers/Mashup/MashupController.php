<?php

namespace App\Http\Controllers\Mashup;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AutenticadorController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Mashup;
use App\Http\Controllers\Mashup\ComponenteController;
use DB;

class MashupController extends Controller
{

  public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['']]);
   }

    public function verMashup(Request $request)
  {
        // $cuentas = Cuenta::all();
        // //Ejemplo de where
        $mashup = Mashup::where('usuarios_id',$request->input('usuarios_id'))->get();
        // $sucursal = Sucursal::find($usuario->sucursal_id);
        // $empresa = Empresa::find($sucursal->empresa_id)->get();
        return response()->json(compact('mashup'));
	    
  }

  public function verMisMashups(Request $request)
  {
        $verficiar =  new AutenticadorController();
        if($verficiar->verificarUsuario($request))
        {
          $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
          $mashups = DB::select("select mashups.nombre, conjunto_satisfaccion_mashup.avg, conjunto_satisfaccion_mashup.fecha, 
                         conjunto_satisfaccion_mashup.usuario_id, conjunto_satisfaccion_mashup.mashup_id 
                         from mashups 
                         left join conjunto_satisfaccion_mashup 
                         on mashups.id = conjunto_satisfaccion_mashup.mashup_id 
                         where conjunto_satisfaccion_mashup.fecha >= 
                         (select to_date(to_char(fecha,'DD-MM-YYYY'),'DD-MM-YYYY') 
                         from conjunto_satisfaccion_mashup order by fecha desc limit 1) 
                         and conjunto_satisfaccion_mashup.usuario_id = ".$usuarioID." 
                         order by conjunto_satisfaccion_mashup.fecha asc;");
          return response()->json(compact('mashups'));
        }      
        if($verficiar->verificarAdministrador($request))
        {
          $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
          $mashups = DB::select("select mashups.nombre, conjunto_satisfaccion_mashup.avg, conjunto_satisfaccion_mashup.fecha, 
                         conjunto_satisfaccion_mashup.usuario_id, conjunto_satisfaccion_mashup.mashup_id 
                         from mashups 
                         left join conjunto_satisfaccion_mashup 
                         on mashups.id = conjunto_satisfaccion_mashup.mashup_id 
                         where conjunto_satisfaccion_mashup.fecha >= 
                         (select to_date(to_char(fecha,'DD-MM-YYYY'),'DD-MM-YYYY') 
                         from conjunto_satisfaccion_mashup order by fecha desc limit 1) 
                         order by conjunto_satisfaccion_mashup.fecha asc;");
          return response()->json(compact('mashups'));
        }
  }

  //API CRUD
  // public function crearMashup(Request $request)
  // {

  //       $crearMashup = [
  //         'nombre' => $request->input('nombre'),
  //         'descripcion' => $request->input('descripcion'),
  // 		    'url' => $request->input('url'),
  // 		    'usuarios_id' =>  $request->input('usuarios_id') //hay que cambiarlo al usuario de token
  //       ];
  //       $mashup = Mashup::create($crearMashup);
  //       $nombre = $mashup->nombre;
  //       return response()->json(compact('nombre'));
	    
  // }

  public function crearMashup(Request $request)
  {
    $verficiar =  new AutenticadorController();
    if($verficiar->verificarUsuario($request))
    {
      $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
      // $api = Api::where('id',$request->input('id'))->first();
      // echo $request;

      $crearMashup = [
          'nombre' => $request->input('nombre'),
          'descripcion' => $request->input('descripcion'),
          'url' => $request->input('url'),
          'usuario_id' => $usuarioID //hay que cambiarlo al usuario de token
        ];
      $compo =  new ComponenteController();
      $componentes = $request->input('apis');
      $mashup = Mashup::create($crearMashup);
      $id = $mashup->id;
      foreach ($componentes as $key => $componente) {
        $compo->crearComponenteLocal($componente, $id);
      }

      return response()->json(compact('usuarioID'));
    }
    if($verficiar->verificarAdministrador($request))
    {
      $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
      // $api = Api::where('id',$request->input('id'))->first();
      // echo $request;

      $crearMashup = [
          'nombre' => $request->input('nombre'),
          'descripcion' => $request->input('descripcion'),
          'url' => $request->input('url'),
          'usuario_id' => $usuarioID //hay que cambiarlo al usuario de token
        ];
      $compo =  new ComponenteController();
      $componentes = $request->input('apis');
      $mashup = Mashup::create($crearMashup);
      $id = $mashup->id;
      foreach ($componentes as $key => $componente) {
        $compo->crearComponenteLocal($componente, $id);
      }

      return response()->json(compact('usuarioID'));
    }
  }

}
//Lineas 23