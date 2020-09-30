<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('login', 'Auth\LoginController@index')->name('login');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');
Route::get('register','Auth\RegisterController@create');
Route::post('register','Auth\RegisterController@store');
Route::get('/main', 'MainController@index')->name('main');
Route::get('/users','UsersController@index')->name('listar_users');
Route::get('/users/create','UsersController@create')->name('adicionar_users');
Route::post('/users','UsersController@store');
Route::get('/users/{id}/edit','UsersController@edit')->name('alterar_users');
Route::put('/users/{id}','UsersController@update');
Route::delete('/users/{id}','UsersController@destroy');
Route::get('/produtos','ProdutosController@index')->name('listar_produtos');
Route::get('/produtos/create','ProdutosController@create')->name('adicionar_produtos');
Route::post('/produtos','ProdutosController@store');
Route::get('/produtos/{id}/edit','ProdutosController@edit')->name('alterar_produtos');
Route::put('/produtos/{id}','ProdutosController@update');
Route::delete('/produtos/{id}','ProdutosController@destroy');
Route::get('/vendas','VendasController@index')->name('vendas');
Route::post('/vendas','VendasController@store');
