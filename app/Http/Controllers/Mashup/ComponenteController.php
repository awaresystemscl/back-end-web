<?php

namespace App\Http\Controllers\Mashup;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AutenticadorController;
use App\Http\Controllers\Controller;
use App\Modelos\Componente;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Factores\FactorController;
use App\Http\Controllers\Mashup\RelacionComFacController;
use DB;


class ComponenteController extends Controller
{
    public function verComponente(Request $request)
  {
        $componente = Componente::where('id',$request->input('id'))->get();
        return response()->json(compact('componente'));
	    
  }

  public function crearComponenteLocal($componente, $mashup_id)
  {
        $api =  new ApiController();
        $factor =  new FactorController();
        $relacionComFac =  new RelacionComFacController();
        $url = $componente['url'];
        $urlUnica = (parse_url($url, PHP_URL_HOST).parse_url($url, PHP_URL_PATH));
        $resultado = $api->verUrlUnica($urlUnica);
        $apiId = null;

        if($resultado == ""){ //si no existe la api
          $apiId = $api->crearApiLocal($componente,$urlUnica);
        }
        else //si existe la api
        {
          $apiId = $resultado['id'];
        }
        $crearComponente = [
            'categoria' => $componente['categoria'],
            'descripcion' => $componente['descripcion'],
            'url' => $componente['url'],
            'mashup_id' => $mashup_id,
            'api_id' => $apiId
          ];
        $componenteCreado = Componente::create($crearComponente);
        $idComponente = $componenteCreado->id;


        foreach ($componente['factores'] as $key => $fac) {
          $resultadoFactor = $factor->verNombreFactorLocal($fac['nombre']);
          $idFactor = $resultadoFactor['id'];
          $idComFac = $relacionComFac->crearRelacionComFacLocal($idFactor, $idComponente, $fac);
        }
        return response()->json(compact('idComponente'));
	    
  }

    public function test(Request $request)
  {
        $url = $request->input('url');
        $urlUnica = (parse_url($url, PHP_URL_HOST).parse_url($url, PHP_URL_PATH));

  }

  public function verMisComponentes(Request $request)
  {
        $verficiar =  new AutenticadorController();
        if($verficiar->verificarUsuario($request))
        {
          $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
          $componentes = DB::select("select apis.nombre, conjunto_satisfaccion_compo.avg, conjunto_satisfaccion_compo.fecha, 
                      conjunto_satisfaccion_compo.mashup_id, componentes.id as componente_id
                      from conjunto_satisfaccion_compo 
                      left join componentes 
                      on componentes.id = conjunto_satisfaccion_compo.componente_id 
                      left join apis 
                      on componentes.api_id = apis.id 
                      where conjunto_satisfaccion_compo.fecha >= 
                      (select to_date(to_char(fecha,'DD-MM-YYYY'),'DD-MM-YYYY') 
                      from conjunto_satisfaccion_compo order by fecha desc limit 1) 
                      and conjunto_satisfaccion_compo.mashup_id = ".$request->input('id')." 
                      order by conjunto_satisfaccion_compo.fecha asc;");
          return response()->json(compact('componentes'));
        }      
        if($verficiar->verificarAdministrador($request))
        {
          $componentes = DB::select("select apis.nombre, conjunto_satisfaccion_compo.avg, conjunto_satisfaccion_compo.fecha, 
                      conjunto_satisfaccion_compo.mashup_id, componentes.id as componente_id
                      from conjunto_satisfaccion_compo 
                      left join componentes 
                      on componentes.id = conjunto_satisfaccion_compo.componente_id 
                      left join apis 
                      on componentes.api_id = apis.id 
                      where conjunto_satisfaccion_compo.fecha >= 
                      (select to_date(to_char(fecha,'DD-MM-YYYY'),'DD-MM-YYYY') 
                      from conjunto_satisfaccion_compo order by fecha desc limit 1) 
                      and conjunto_satisfaccion_compo.mashup_id = ".$request->input('id')." 
                      order by conjunto_satisfaccion_compo.fecha asc;");
          return response()->json(compact('componentes'));
        }
  }


  public function verRestriccionesDeComponente(Request $request)
  {
        $verficiar =  new AutenticadorController();
        if($verficiar->verificarUsuario($request))
        {
          $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
          $restricciones = DB::select("select factores.nombre, relacion_com_fac.nivel
                      from relacion_com_fac
                      join factores
                      on factores.id = relacion_com_fac.factor_id 
                      where relacion_com_fac.componente_id = ".$request->input('componente_id'));
          return response()->json(compact('restricciones'));
        }
        if($verficiar->verificarAdministrador($request))
        {
          $usuarioID = JWTAuth::toUser(JWTAuth::getToken())->id;
          $restricciones = DB::select("select factores.nombre, relacion_com_fac.nivel
                      from relacion_com_fac
                      join factores
                      on factores.id = relacion_com_fac.factor_id 
                      where relacion_com_fac.componente_id = ".$request->input('componente_id'));
          return response()->json(compact('restricciones'));
        }

  }

}
//Lineas 27