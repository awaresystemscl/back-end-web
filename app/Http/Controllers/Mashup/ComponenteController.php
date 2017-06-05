<?php

namespace App\Http\Controllers\Mashup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Componente;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Factores\FactorController;
use App\Http\Controllers\Mashup\RelacionComFacController;


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
        $resultado = $api->verNombreDeApiLocal($componente['nombre']);
        $apiId = null;

        if($resultado == ""){ //si no existe la api
          $apiId = $api->crearApiLocal($componente);
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
}
//Lineas 27