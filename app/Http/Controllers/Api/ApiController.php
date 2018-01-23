<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AutenticadorController;
use App\Modelos\Api;
use App\Modelos\ApiDataTest;
use App\Modelos\Componente;
use App\Modelos\EstadisticaCuartil;
use DB;

class ApiController extends Controller
{
  public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['apisDataTest','estadisticaCuartil','categoriaApis']]);
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

  public function verUrlUnica($urlUnica)
  {
        $api = Api::where('urlUnica',$urlUnica)->first();
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

  public function crearApiLocal($request, $urlUnica)
  {
        $crearApi = [
    			'nombre' => $request['nombre'],
    			'descripcion' => $request['descripcion'],
    			'url' => $request['url'],
          'urlUnica' => $urlUnica
        ];
        $api = Api::create($crearApi);
        $id = $api->id;
        return $id;
	    
  }

    public function apisDataTest(Request $request)
  {
      $api = ApiDataTest::orderBy('id', 'desc')->take(50)->get();
      return response()->json(compact('api'));

  }

  public function verUltimoApiTest(Request $request)
  {
    $ultimo_test = DB::select("select apis_data_test.* from apis_data_test 
                join apis on apis_data_test.nombre = apis.nombre 
                join componentes on componentes.api_id = apis.id 
                where componentes.id = ".$request['componente_id']." 
                order by apis_data_test.fecha desc limit 1;");
    return response()->json(compact('ultimo_test'));
  }

    public function estadisticaCuartil(Request $request)
  {

    $estadistica_cuartil = DB::select("select * from estadistica_cuartil 
                join componentes 
                on estadistica_cuartil.categoria = componentes.categoria 
                where componentes.id = ".$request['componente_id']." 
                order by estadistica_cuartil.fecha desc limit 25;");
    return response()->json(compact('estadistica_cuartil'));
  }

  public function categoriaApis(Request $request)
  {
    $categoria = Componente::where('id', $request['componente_id'])->first();
    $apis = Api::all();
    $categorias = [];
    // print_r($categoria->categoria);
    foreach ($apis as $key => $api) {
      $categoriaApi = DB::select("select count(api.nombre), componentes.categoria, api.nombre, apis_data_test.* 
                  from (select * from apis where nombre = '".$api->nombre."') as api
                  join componentes on componentes.api_id = api.id
                  join apis_data_test on apis_data_test.nombre = '".$api->nombre."' 
                  where componentes.categoria = '".$categoria->categoria."'
                  group by componentes.categoria, api.nombre, apis_data_test.id 
                  order by fecha desc limit 1");
      array_push($categorias,$categoriaApi);
      }
      return response()->json(compact('categorias'));
  }




}
//Lineas 28