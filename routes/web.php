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


// トップページ
Route::get('/', 'TopPageController@index')->name('public_view');
Route::get('/search', 'TopPageController@search')->name('public_view_search');
Route::get('/tag/{tag_id}', 'TopPageController@tag')->name('public_view_tag');
Route::get('/item/{quiz_id}', 'QuizViewController@item')->name('public_view_item');

// クイズ取得
Route::get('/item/{quiz_id}/content', 'QuizViewController@content');

//Route::get('/auth', function () {
//    return view('auth');
//})->name('auth');


// Twitterログイン・認証
Route::get('/twitter/login', function () {
    return view('public_views.twitter_login');
})->name('twitter_login');

Route::get('/auth/twitter', 'Auth\LoginController@redirectToProvider')->name('auth_twitter');
Route::get('/auth/twitter/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/auth/twitter/logout', 'Auth\LoginController@logout')->name('auth_logout');


// クイズ作成遷移時
Route::get('/create-quiz', 'CreateQuiz')->name('create_quiz');
// クイズ作成
Route::group(['middleware' => 'auth'], function () {
    Route::get('/my_page/index', 'QuizController@index')->name('my_page_index');
    Route::get('/my_page/create', 'QuizController@create')->name('my_page_create');
    Route::post('/my_page/store', 'QuizController@store')->name('my_page_store');
});
