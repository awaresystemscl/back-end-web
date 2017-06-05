<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\RelacionApiCat;

class RelacionApiCatController extends Controller
{
    public function verRelacionApiCat(Request $request)
  {
        $relacionApiCat = RelacionApiCat::where('id',$request->input('id'))->get();
        return response()->json(compact('relacionApiCat'));
	    
  }

  public function crearRelacionApiCat(Request $request)
  {
        $crearRelacionApiCat = [
			'apis_id' => $request->input('apis_id'),
			'categorias_id' => $request->input('categorias_id'),
			'ponderacion' => $request->input('ponderacion'),
        ];
        $relacionApiCat = RelacionApiCat::create($crearRelacionApiCat);
        $ponderacion = $relacionApiCat->ponderacion;
        return response()->json(compact('ponderacion'));
	    
  }
}
//Lineas 12
