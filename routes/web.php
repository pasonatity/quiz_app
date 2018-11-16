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

Route::get('/', 'TopPageController@index')->name('public_view');
Route::get('/search', 'TopPageController@search')->name('public_view_search');
Route::get('/tag/{tag_id}', 'TopPageController@tag')->name('public_view_tag');
Route::get('/item/{quiz_id}', 'QuizViewController@item')->name('public_view_item');

Route::get('/item/{quiz_id}/content', 'QuizViewController@content');

//Route::get('/auth', function () {
//    return view('auth');
//})->name('auth');

Route::get('/quiz/create', 'QuizController@create')->name('quiz_create');
Route::post('/quiz/store', 'QuizController@store')->name('quiz_store');
