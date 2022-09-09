<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//登陆注册模块

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('me', 'AuthController@me');
Route::post('token', 'AuthController@token');


//授权接口
Route::middleware(['auth:sanctum','api.permission'])->group(function () {
    
    //系统模块
    Route::resource('auth/users','UserController');
    Route::resource('auth/permissions','PermissionController');
    Route::resource('auth/roles' ,'RoleController');
    Route::resource('auth/menus' ,'MenuController');
    Route::resource('auth/Logs' ,'LogController');
    Route::resource('companies', "CompanyController");
    Route::resource('departments', "DepartmentController");

    //基础信息模块
    Route::resource('products', "ProductController");
    
});

//用户必须接口 无需授权 需登录
Route::middleware(['auth:sanctum'])->group(function () {
    //菜单列表
    Route::get('my-menu' , 'PubController@menu');
    //站内信接口
    Route::get('message' ,'PubController@me');
    
});

//dcat接口
Route::prefix('pub')->group(function () {
    //菜单列表
    Route::get('orders' , 'ApiController@orders')->name('pub.orders');

    
});
