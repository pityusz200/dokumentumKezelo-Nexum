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

//Fokategoria
Route::get('/', 'foKategoriakController@index');
Route::get('fooldal/index', 'foKategoriakController@index');
Route::get('/ujFoKategoriaHozzadasa', 'foKategoriakController@ujFoKategoriaHozzadasaTov');
Route::post('ujFoKategoriaHozzadasa/ujFoKategoriaHozzadasa', ['uses' => 'foKategoriakController@ujFoKategoriaHozzadasa', 'as' => 'ujFoKategoriaHozzadasa_fokategoria']);

Route::post('fooldal/foKnevValtozatas', ['uses' => 'foKategoriakController@foKnevValtozatas', 'as' => 'foKnevValtozatas_fokategoria']);
Route::post('fooldal/foKtorles', ['uses' => 'foKategoriakController@foKtorles', 'as' => 'foKtorles_fokategoria']);


//Ajax fájlok
Route::get('/fooldal/modals/modals/{foKategoria}', 'foKategoriakController@modals');

//Alkategoria
Route::resource('alkategoriaOldal', 'alkategoriakController');

Route::get('/alkategoriaOldal/ujAlKategoriaHozzadasa/{fokategoria}', 'alkategoriakController@ujAlKategoriaHozzadasaTov');
Route::get('/alkategoriaOldal/index/{fokategoriak}', 'alkategoriakController@index');
Route::post('ujAlKategoriaHozzadasa/ujAlKategoriaHozzadasa', ['uses' => 'alkategoriakController@ujAlKategoriaHozzadasa', 'as' => 'ujAlKategoriaHozzadasa_alkategoria']);

Route::post('alkategoriaOldal/alKnevValtozatas', ['uses' => 'alkategoriakController@alKnevValtozatas', 'as' => 'alKnevValtozatas_alkategoria']);
Route::post('alkategoriaOldal/alKtorles', ['uses' => 'alkategoriakController@alKtorles', 'as' => 'alKtorles_alkategoria']);

//Fájl
Route::post('alkategoriaOldal/fajlFeltolto', ['uses' => 'alkategoriakController@fajlFeltolto', 'as' => 'fajlFeltolto_alkategoria']);
Route::post('alkategoriaOldal/deleteFile', ['uses' => 'alkategoriakController@deleteFile', 'as' => 'deleteFile_alkategoria']);

//Ajax fájlok
Route::get('/alkategoriaOldal/modals/modals/{fokategoriak}/{alkategoriak}', 'alkategoriakController@modals');
Route::get('/alkategoriaOldal/modals/dokumentumokTable/{fokategoriak}/{alkategoria}', 'alkategoriakController@dokumentumokTable');
Route::get('/alkategoriaOldal/modals/deleteFile/{foKategoria}/{alKategoria}/{fileId}', 'alkategoriakController@deleteFileTov');

Auth::routes();

  Route::get('/home', 'foKategoriakController@index');

  Route::get('/logout', 'Auth\LoginController@logout');