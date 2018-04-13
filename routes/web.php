<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
//首页
Route::get('/','Index\IndexController@get');
//发言
Route::post('/content','Index\IndexController@content');
//发言分页
Route::post('/comment','Index\IndexController@comment');
//回复
Route::post('/sub','Index\IndexController@sub');
//查看子评论
Route::post('/subreview','Index\IndexController@subreview');

//注册
Route::get('/register', 'Index\RegisterController@get');
Route::post('/register', 'Index\RegisterController@register');

//登录
Route::get('/login', 'Index\LoginController@get' );
Route::post('/login', 'Index\LoginController@login');

//后台管理
Route::get('/admin', 'Index\AdminController@admin' );
//后台发言编辑管理
Route::post('/admin/edit', 'Index\AdminController@edit' );
//后台发言删除管理
Route::post('/admin/delete', 'Index\AdminController@delete' );
