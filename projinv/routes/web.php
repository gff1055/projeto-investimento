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

Route::get('/', ['uses'=>'Controller@homep']);
Route::get('/cadastro', ['uses'=>'Controller@cad']);
Route::get('/login', ['uses'=>'Controller@fazLog']);

/*Route::get('/', function () {
	echo "Mensagem";
    //return view('welcome');
});*/
