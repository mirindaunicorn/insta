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
    Route::get('/u/{name}', 'UserController@showByName')->name('users.by.name');
    Route::resource('posts', 'PostController');
    Route::resource('comments', 'CommentController');

    Route::middleware(['only.admin'])->group(function () {
        Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard.index');
        Route::get('/dashboard/users', 'Dashboard\DashboardController@users')->name('dashboard.users');
        Route::get('/dashboard/users/{user}/edit',
            'Dashboard\DashboardController@editUser')->name('dashboard.users.edit');
        Route::get('/dashboard/comments', 'Dashboard\DashboardController@comments')->name('dashboard.comments');
        Route::get('/dashboard/comments/{comment}/edit',
            'Dashboard\DashboardController@editComment')->name('dashboard.comments.edit');
        Route::get('/dashboard/posts', 'Dashboard\DashboardController@posts')->name('dashboard.posts');
        Route::get('/dashboard/posts/{post}/edit',
            'Dashboard\DashboardController@editPost')->name('dashboard.posts.edit');
    });
});
