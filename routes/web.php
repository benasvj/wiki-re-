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


Auth::routes();
Route::resource('posts', 'PostsController');
Route::get('/', 'PostsController@index');

Route::resource('categories', 'CategoriesController');

Route::get('/filter_posts/{id}', 'PostsController@filter')->name('filter_posts');

Route::get('/controll_posts', 'PostsController@controll')->name('controll_posts');

//bandziau su posts.destroy arba posts.edit bet kazkodel mete error "no message" todel palikau atskirus route
Route::post('/post/delete/{id}', 'PostsController@destroy')->name('delete_post');

Route::post('/update/post/{id}', 'PostsController@update')->name('update_post');

Route::post('/search/post', 'PostsController@index')->name('search_post');