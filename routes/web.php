<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'cors'], function() {
    //Validacion de Login creacion del token
    Route::post('/autenticacion', 'AutenticadorController@autenticarUsuario');
    
    
    //Gestion de mashups
    Route::get('/mashup', 'Mashup\MashupController@verMashup');
    Route::post('/mashup', 'Mashup\MashupController@crearMashup');
    // Route::delete('/mashup', 'MashupController@eliminarMashup');
    // Route::update('/mashup', 'MashupController@editarMashup');

    //Gestion de api
    Route::get('/api', 'Api\ApiController@verApi');
    Route::post('/api', 'Api\ApiController@crearApi');
    // Route::delete('/api', 'Api@eliminarApi');
    // Route::update('/api', 'Api@editarApi');

    //Gestion de categoria
    Route::get('/categoria', 'Api\CategoriaController@verCategoria');
    Route::post('/categoria', 'Api\CategoriaController@crearCategoria');
    // Route::delete('/categoria', 'Api\CategoriaController@eliminarCategoria');
    // Route::update('/categoria', 'Api\CategoriaController@editarCategoria');

    //Gestion de componente
    Route::get('/componente', 'Mashup\ComponenteController@verComponente');
    Route::post('/componente', 'Mashup\ComponenteController@crearComponente');
    // Route::delete('/componente', 'Mashup\ComponenteController@eliminarComponente');
    // Route::update('/componente', 'Mashup\ComponenteController@editarComponente');

    //Gestion de factor
    Route::get('/factor', 'Factores\FactorController@verFactor');
    Route::post('/factor', 'Factores\FactorController@crearFactor');
    // Route::delete('/factor', 'Factores\FactorController@eliminarFactor');
    // Route::update('/factor', 'Factores\FactorController@editarFactor');

    //Gestion de relacion api categoria
    Route::get('/relacionApiCat', 'Api\RelacionApiCatController@verRelacionApiCat');
    Route::post('/relacionApiCat', 'Api\RelacionApiCatController@crearRelacionApiCat');
    // Route::delete('/relacionApiCat', 'Api\RelacionApiCatController@eliminarRelacionApiCat');
    // Route::update('/relacionApiCat', 'Api\RelacionApiCatController@editarRelacionApiCat');

    //Gestion de relacion api factor
    Route::get('/relacionApiFac', 'Api\RelacionApiFacController@verRelacionApiCat');
    Route::post('/relacionApiFac', 'Api\RelacionApiFacController@crearRelacionApiCat');
    // Route::delete('/relacionApiFac', 'Api\RelacionApiFacController@eliminarRelacionApiFac');
    // Route::update('/relacionApiFac', 'Api\RelacionApiFacController@editarRelacionApiFac');

    //Gestion de relacion componente factor
    Route::get('/relacionComFac', 'Mashup\RelacionComFacController@verRelacionComFac');
    Route::post('/relacionComFac', 'Mashup\RelacionComFacController@crearRelacionComFac');
    // Route::delete('/relacionComFac', 'Mashup\RelacionComFacController@eliminarRelacionComFac');
    // Route::update('/relacionComFac', 'Mashup\RelacionComFacController@editarRelacionComFac');

    



    //Route::post('/test', 'VoucherController@test');
    //Gestion de Usuarios
    //visualizar devuelve los datos de un objeto
    // Route::post('/vistaGestionarUsuarios', 'UsuarioController@vistaGestionarUsuarios');
    // Route::post('/crearUsuario', 'UsuarioController@crearUsuario');
    // Route::post('/visualizarUsuario', 'UsuarioController@visualizarUsuario');
    // Route::post('/editarUsuario', 'UsuarioController@editarUsuario');
    // Route::post('/eliminarUsuario', 'UsuarioController@eliminarUsuario');
    // //Gestionar Pagos
    // Route::post('/vistaGestionarPagos', 'PagosController@vistaGestionarPagos');
    // //Imprimir Voucher
    // Route::post('/vistaImprimirVoucher', 'VoucherController@vistaImprimirVoucher');
    // Route::post('/imprimirVoucher', 'ImprimirController@imprimirVoucher');
    // //Estadisticas
    // Route::post('/vistaEstadisticas', 'EstadisticasController@vistaEstadisticas');

    
    
});
//Lineas 18