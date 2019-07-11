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
Route::resource('/posts', 'PostsController');
Auth::routes();
Route::get('/myphotos', 'MyphotosController@index');
Route::get('/favorites', 'FavoritesController@index');
Route::group(['prefix' => 'posts/{id}'], function () {
  Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
  Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
});
