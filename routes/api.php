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
    Route::resource('companies', "CompanyController");
    Route::resource('products', "ProductController");
});

//用户公共接口 无需授权
Route::middleware([])->group(function () {
    //菜单列表
    Route::get('menu' , 'PubController@menu');

    
});

//dcat接口
Route::prefix('pub')->group(function () {
    //菜单列表
    Route::get('orders' , 'ApiController@orders')->name('pub.orders');

    
});
