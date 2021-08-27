<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/ping', function(Request $request) {
    return ['pong' => true];
});

Route::get('/notes', 'TarefaController@getAll');
Route::get('/notes/{id}', 'TarefaController@getIOne');

Route::post('/notes', 'TarefaController@create');

Route::put('/notes/{id}', 'TarefaController@edit');

Route::delete('/notes/{id}', 'TarefaController@remove');

