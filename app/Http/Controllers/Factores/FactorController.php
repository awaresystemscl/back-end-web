<?php

namespace App\Http\Controllers\Factores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Factor;

class FactorController extends Controller
{
    public function verFactor(Request $request)
  {
        $factor = Factor::where('id',$request->input('id'))->get();
        return response()->json(compact('factor'));
	    
  }

  public function verNombreFactorLocal($nombre)
  {
        $factor = Factor::where('nombre',$nombre)->first();
        return $factor;
      
  }

  public function crearFactor(Request $request)
  {
        $crearFactor = [
			'nombre' => $request->input('nombre')
        ];
        $factor = Factor::create($crearFactor);
        $nombre = $factor->nombre;
        return response()->json(compact('nombre'));
	    
  }
}
//Lineas 13