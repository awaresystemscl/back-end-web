<?php

namespace App\Http\Controllers\Mashup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\RelacionComFac;

class RelacionComFacController extends Controller
{
    public function verRelacionComFac(Request $request)
  {
        $relacionComFac = RelacionComFac::where('id',$request->input('id'))->get();
        return response()->json(compact('relacionComFac'));
	    
  }

  public function crearRelacionComFac(Request $request)
  {
        $crearRelacionComFac = [
			'componentes_id' => $request->input('componentes_id'),
			'factores_id' => $request->input('factores_id'),
			'nivel' => $request->input('nivel'),
			'tendencia' => $request->input('a_lo_mas')
        ];
        $relacionComFac = RelacionComFac::create($crearRelacionComFac);
        $id = $relacionComFac->id;
        return response()->json(compact('id'));
	    
  }

  public function crearRelacionComFacLocal($idFac, $idCom, $calidad)
  {
        $crearRelacionComFac = [
          'componente_id' => $idCom,
          'factor_id' => $idFac,
          'nivel' => $calidad['nivel'],
          'union' => $calidad['union'],
          'posicion' => $calidad['posicion'],
          'tendencia' => $calidad['tendencia']
        ];
        $relacionComFac = RelacionComFac::create($crearRelacionComFac);
        $id = $relacionComFac->id;
        return $id;
      
  }
}
//Lineas 24