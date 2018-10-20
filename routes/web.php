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


//Route::get('/','AccountController@index')->name('account');

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'PublicViewController@index')->name('public_view');
Route::get('/search', 'PublicViewController@search')->name('public_view_search');
Route::get('/tag/{tag_id}', 'PublicViewController@tag')->name('public_view_tag');
Route::get('/item/{quiz_id}', 'PublicViewController@item')->name('public_view_item');

Route::get('/item/{quiz_id}/content', 'PublicViewController@content');
