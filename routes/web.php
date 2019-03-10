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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::patch('/posts/{post}/like', 'PostController@like')->name('posts.like');
    Route::patch('/users/{user}/subscribe', 'UserController@subscribe')->name('users.subscribe');
    Route::get('/users/{user}/subscriptions', 'UserController@subscriptions')->name('users.subscriptions');
    Route::get('/users/{user}/subscribers', 'UserController@subscribers')->name('users.subscribers');

    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
    Route::resource('comments', 'CommentController');
});

