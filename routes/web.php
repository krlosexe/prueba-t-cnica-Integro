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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/users', function () {
    return view('users');
});


Route::get('/peliculas', function () {
    return view('peliculas');
});


Route::get('get-users', 'Users@getUsers');
Route::post('store-user', 'Users@storeUser');
Route::get('delete-user', 'Users@deleteUser');
Route::post('update-user', 'Users@updateUser');


Route::get('get-peliculas', 'Peliculas@select');
Route::post('store-peliculas', 'Peliculas@store');
Route::post('update-peliculas', 'Peliculas@update');
Route::get('delete-pelicula', 'Peliculas@delete');




