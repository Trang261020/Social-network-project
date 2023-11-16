<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('admin-login', 'Admin\Auth\LoginController@adminLogin');
Route::post('admin-login', ['as'=>'admin-login','uses'=>'Admin\Auth\LoginController@adminLoginPost']);

Route::get('dashboard', 'Admin\ManagementController@showUser')->name('dashboard.user');
Route::get('/dashboard/post', 'Admin\ManagementController@showPost')->name('dashboard.post');

Route::get('/user/edit/{id}', 'Admin\ManagementController@userShow')->name('show.user');
Route::post('/user/search', 'Admin\ManagementController@searchUser')->name('search.user');
Route::post('/user/edit/{id}', 'Admin\ManagementController@editUser')->name('edit.user');
Route::get('/user/delete/{id}', 'Admin\ManagementController@deleteUser')->name('delete.user');


Route::get('/post/edit/{id}', 'Admin\ManagementController@postShow')->name('show.post');
Route::post('/post/search', 'Admin\ManagementController@searchPost')->name('search.post');
Route::post('/post/edit/{id}', 'Admin\ManagementController@editPost')->name('edit.post');
Route::get('/post/delete/{id}', 'Admin\ManagementController@deletePost')->name('delete.post');
