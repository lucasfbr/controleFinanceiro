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


Route::group(['middleware' => ['auth'], 'prefix' => 'painel'], function (){

    Route::get('/', ['uses' => 'PainelController@index']);
    Route::get('/category-costs', ['uses' => 'CategoryCostsController@index']);
    Route::get('/category-costs/add', ['uses' => 'CategoryCostsController@add']);
    Route::post('/category-costs/create', ['uses' => 'CategoryCostsController@create']);
    Route::get('/category-costs/edit/{id}', ['uses' => 'CategoryCostsController@edit']);
    Route::post('/category-costs/update/{id}', ['uses' => 'CategoryCostsController@update']);
    Route::get('/category-costs/delete/{id}', ['uses' => 'CategoryCostsController@delete']);

    Route::get('/users', ['uses' => 'UsersController@index']);
    Route::get('/users/add', ['uses' => 'UsersController@add']);
    Route::post('/users/create', ['uses' => 'UsersController@create']);
    Route::get('/users/edit/{id}', ['uses' => 'UsersController@edit']);
    Route::post('/users/update/{id}', ['uses' => 'UsersController@update']);
    Route::get('/users/delete/{id}', ['uses' => 'UsersController@delete']);

});

Auth::routes();

Route::get('/', ['uses' => 'HomeController@index']);

