<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/','PostsController@index');
Route::get('/create','PostsController@create');
Route::post('/create','PostsController@store');
Route::get('/comments','CommentsController@index');
Route::put('/{id}/edit','PostsController@update');
Route::get('/{id}/edit','PostsController@edit');
Route::get('/{id}/delete','PostsController@destroy');
Route::get('/{id}','PostsController@show');

Route::get('/delete_comment/{id}','CommentsController@destroy');
Route::post('/{id}','CommentsController@store');
