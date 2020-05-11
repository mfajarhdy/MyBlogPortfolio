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

Route::get('/', 'BlogController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/category','CategorysController');
Route::resource('/tag','TagsController');
Route::get('/post/hapus', 'PostsController@tampil_hapus')->name('post.hapus');
Route::get('/post/restore/{id}', 'PostsController@restore')->name('post.restore');
Route::delete('/post/kill/{id}', 'PostsController@kill')->name('post.kill');
Route::resource('/post','PostsController');
Route::resource('/user','UsersController');

