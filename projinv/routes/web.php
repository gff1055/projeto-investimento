<?php

Route::get('/', [                               // DEFINICAO DA ROTA RAIZ (classe ROUTE)
        'uses'  =>'Controller@homepage'
]);


Route::get('/cadastro',[
    'uses'  =>'Controller@cadastrar'
]);

/* Rotas para a autenticacao do usuario */

Route::get('/login', [
        'uses'  =>'Controller@fazerLogin'
]);

Route::post('/login', [
        'as'    =>'user.login',                 // DANDO NOME PARA A ROTA
        'uses'  =>'DashboardController@auth'    // METODO QUE FAZ A AUTENTICACAO
    ]
);

Route::get('/dashboard', [
        'as'    =>'user.dashboard',             // NOME DADO PARA A ROTA
        'uses'  =>'DashboardController@index'
]);

Route::get('/user', [
    'as'    => 'user.index',
    'uses' => 'UsersController@index'
]);



Route::get('getback', [                        // URL...
    'as' => 'moviment.getback',             // nome da rota
    'uses' => 'MovimentsController@getback' // Metodo do controler onde sera redirecionado
]);

Route::post('getback', [                        // Rota para resgate financeiro
    'as' => 'moviment.getback.store',
    'uses' => 'MovimentsController@storeGetback'
]);


Route::get('moviment', [                        // URL...
    'as' => 'moviment.application',             // nome da rota
    'uses' => 'MovimentsController@application' // Metodo do controler onde sera redirecionado
]);

Route::post('moviment', [
    'as' => 'moviment.application.store',
    'uses' => 'MovimentsController@storeApplication'
]);

Route::get('user/moviment', [                   // Rota para os movimentos do usuario
    'as' => 'moviment.index',
    'uses' => 'MovimentsController@index'
]);



Route::get('moviment/all', [                    // Rota para listar todos os movimentos do usuario
    'as' => 'moviment.all',
    'uses' => 'MovimentsController@all',
]);



Route::resource(                                // DEFININDO UM GRUPO DE ROTAS(delete, update, etc...) PARA USERS(usersController)
    'user',                                     // Nome da rota
    'UsersController'                           // Nome do controller
    // Array de dados (Nome das rotas)
    /*
    ..........
    */
);

Route::resource('institution','InstitutionsController');    // Cria estrutura (INDEX, STORE, ETC....) para as instituicoes
Route::resource('group', 'GroupsController');   // Rota RESOURCE (rotas para INDEX, STORE, UPDATE, NEW, SHOW, CREATE....) para GROUPS
Route::resource('institution.product','ProductsController');    // Nessa rota o escopo de produto esta dentro da instituicao

Route::post('group/{group}/user', [
    'as' => 'group.user.store',
    'uses' => 'GroupsController@userStore'
]);





