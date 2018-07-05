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

Route::get('/', function () {return view('welcome');});
Route::get('posts/create', 'PostsController@create');
//コメント機能用のルート
Route::get('posts/{id}/commentedit', 'PostsController@commentEdit')->name('posts.commentedit');
Route::post('/posts/{id}/commentupdate', 'PostsController@commentUpdate')->name('posts.commentupdate');
Route::patch('/posts/{id}/commentupdate', 'PostsController@commentUpdate')->name('posts.commentupdate');
Route::post('/comment', 'PostsController@comment')->name('posts.comment');
Route::delete('posts/commentdelete/{id}','PostsController@commentDelete')->name('posts.commentdelete');

//index,showはログインせずアクセス可能
Route::resource('/posts', 'PostsController', ['only' => ['index', 'show']]);
//そのほかはログイン時のみ許可
Route::group(['middleware' => 'auth'], function () {
Route::resource('/posts', 'PostsController', ['only' => ['store', 'create', 'update', 'destroy', 'edit','commentedit','commentdelete','commentupdate' ]]);
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

