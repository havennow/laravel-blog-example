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

Auth::routes();

Route::group(['prefix' => 'posts', 'middleware' => 'auth', 'as' => 'posts.'], function () {
    Route::get('', ['uses' => 'PostsController@index', 'as' => 'index']);
    Route::get('cadastrar', ['uses' => 'PostsController@create', 'as' => 'create']);
    Route::post('cadastrar', ['uses' => 'PostsController@store', 'as' => 'store']);
    Route::get('{post}', ['uses' => 'PostsController@edit', 'as' => 'edit']);
    Route::post('{post}', ['uses' => 'PostsController@update', 'as' => 'update']);
    Route::get('{post}/remover', ['uses' => 'PostsController@destroy', 'as' => 'destroy']);
});
