<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'movil'], function () {
  Route::post('auth/login', 'Api\AuthController@login');
  Route::apiResource('producto', 'Api\ProductoController');
  Route::apiResource('categoria', 'Api\CategoriaController');
  Route::apiResource('meta', 'Api\MetaController');
  Route::post('meta_graph', 'Api\GraficaController@metaAlcanzada');
  Route::get('compra_grahp/{id}', 'Api\GraficaController@cantidadProductoByCategoria'); //getTop
  Route::get('stock/{id}', 'Api\GraficaController@getStock');
  Route::post('top', 'Api\GraficaController@getTop');
});