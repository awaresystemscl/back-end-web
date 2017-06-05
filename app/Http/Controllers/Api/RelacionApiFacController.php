<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\RelacionApiFac;
use Carbon\Carbon;

class RelacionApiFacController extends Controller
{
    public function verRelacionApiFac(Request $request)
  {
        $relacionApiFac = RelacionApiFac::where('id',$request->input('id'))->get();
        return response()->json(compact('relacionApiFac'));
	    
  }

  public function crearRelacionApiFac(Request $request)
  {
        $crearRelacionApiFac = [
			'apis_id' => $request->input('apis_id'),
			'factores_id' => $request->input('factores_id'),
			'fecha' => Carbon::now(),
        ];
        $relacionApiFac = RelacionApiFac::create($crearRelacionApiFac);
        $ponderacion = $relacionApiFac->ponderacion;
        return response()->json(compact('ponderacion'));
	    
  }
}
//Lineas 12
