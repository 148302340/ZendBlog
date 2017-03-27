<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 前台个人中心
Route::controller('/home/center','home\CenterController');

// 后台用户路由
Route::controller('/admin/user','admin\UserController');

// 后台栏目路由
Route::controller('/admin/cate','admin\CateController');

// 后台文章路由
Route::controller('/admin/para','admin\BlogController');

// 后台友情链接路由
Route::controller('/admin/friendlink','admin\LinkController');

Route::get('/admin/web/set',function(){
	return view('admin.web.set');
});