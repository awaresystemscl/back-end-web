<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function() {
    //Validacion de Login creacion del token
    Route::post('/autenticacion', 'AutenticadorController@autentificadorDeUsuario');
    
    /*
    //Gestion de Voucher
    Route::post('/visualizarVoucher', 'VoucherController@visualizarVoucher');
    //Route::post('/test', 'VoucherController@test');
    //Gestion de Usuarios
    //visualizar devuelve los datos de un objeto
    Route::post('/vistaGestionarUsuarios', 'UsuarioController@vistaGestionarUsuarios');
    Route::post('/crearUsuario', 'UsuarioController@crearUsuario');
    Route::post('/visualizarUsuario', 'UsuarioController@visualizarUsuario');
    Route::post('/editarUsuario', 'UsuarioController@editarUsuario');
    Route::post('/eliminarUsuario', 'UsuarioController@eliminarUsuario');
    //Gestionar Pagos
    Route::post('/vistaGestionarPagos', 'PagosController@vistaGestionarPagos');
    //Imprimir Voucher
    Route::post('/vistaImprimirVoucher', 'VoucherController@vistaImprimirVoucher');
    Route::post('/imprimirVoucher', 'ImprimirController@imprimirVoucher');
    //Estadisticas
    Route::post('/vistaEstadisticas', 'EstadisticasController@vistaEstadisticas');
*/
    
    
});