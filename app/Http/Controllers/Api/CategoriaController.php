<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Categoria;

class CategoriaController extends Controller
{
    public function verCategoria(Request $request)
  {
        $categoria = Categoria::where('id',$request->input('id'))->get();
        return response()->json(compact('categoria'));
	    
  }

  public function crearCategoria(Request $request)
  {
        $crearCategoria = [
			'nombre' => $request->input('nombre')
        ];
        $categoria = Categoria::create($crearCategoria);
        $nombre = $categoria->nombre;
        return response()->json(compact('nombre'));
	    
  }
}
//Lineas 10