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

Route::get('/', 'BlogController@index');

/** Rota para exibição */
Route::get('/noticia/{noticia}', 'BlogController@exibir');

/** Rota única do admin contendo crud de notícias */
Route::get('admin', 'AdminController@index');

