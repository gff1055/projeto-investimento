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

// DEFINICAO DA ROTA RAIZ (classe ROUTE)
Route::get(
    '/',
    [
        'uses'  =>'Controller@homepage'
    ]
);


Route::get(
    '/cadastro',
    [
        'uses'  =>'Controller@cadastrar'
    ]
);



/*
Rotas para a autenticacao do usuario
*/

Route::get(
    '/login',
    [
        'uses'  =>'Controller@fazerLogin'
    ]
);

Route::post(
    '/login',
    [
        //DANDO NOME PARA A ROTA
        'as'    =>'user.login',
        // METODO QUE FAZ A AUTENTICACAO
        'uses'  =>'DashboardController@auth'
    ]
);

Route::get(
    '/dashboard',
    [
        // NOME DADO PARA A ROTA
        'as'    =>'user.dashboard',
        'uses'  =>'DashboardController@index'
    ]
);

Route::get(
    '/user',
    [
        'as'    => 'user.index',
        'uses' => 'UsersController@index'
    ]
);

// DEFININDO UM GRUPO DE ROTAS(delete, update, etc...) PARA USERS(usersController)
Route::resource(
    // NOME DA ROTA
    'user',
    // NOME DO CONTROLLER
    'UsersController'
    // ARRAY DE DADOS(NOME DAS ROTAS)
    /*
    ..........
    */
);


// CRIA ESTRUTURA (index, store, etc....)
Route::resource('institution','InstitutionsController');

Route::resource('group', 'GroupsController');

