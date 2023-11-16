<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use \App\Http\Controllers\Auth\RegisterController;
use \App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/test', [App\Http\Controllers\Controller::class, 'showPublic'])->name('test');
Route::get('/', [App\Http\Controllers\PostsController::class, 'show']);

Route::get('/home', [App\Http\Controllers\PostsController::class, 'show'])->name('home');
Route::post('/home', [App\Http\Controllers\PostsController::class, 'create'])->name('store');

Route::get('/friend', 'FriendController@show')->name('friend.show');
Route::post('/friend/add', 'FriendController@add')->name('friend.add');
Route::post('/friend/accept', 'FriendController@accept')->name('friend.accept');


//Route::post('/post/:id/store', [App\Http\Controllers\PostsController::class, 'create'])->name('store');
//Route::post('/post/:id/update', [App\Http\Controllers\PostsController::class, 'create'])->name('create');

Route::get('/post/delete/{id}', [App\Http\Controllers\PostsController::class, 'delete'])->name('delete');
Route::get('/post/edit/{id}', [App\Http\Controllers\PostsController::class, 'index'])->name('index');
Route::post('/post/edit/{id}', [App\Http\Controllers\PostsController::class, 'edit'])->name('edit');

Route::post('/post/comment', [App\Http\Controllers\PostsController::class, 'comment'])->name('comment');
Route::post('/post/comment/like', [App\Http\Controllers\PostsController::class, 'likeComment'])->name('like_comment');

Route::post('/post/like', [App\Http\Controllers\PostsController::class, 'like'])->name('like');
Route::get('/post/likes', [App\Http\Controllers\PostsController::class, 'showLike'])->name('post_likes');

Route::get('/profile/{user}', 'UserController@show')->name('user.show');
Route::get('/profile', 'UserController@index')->name('user.index');
Route::post('/profile/{user}/edit/', 'UserController@edit')->name('user.edit');

