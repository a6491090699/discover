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

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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
Route::post('login', function (Request $request) {
    if($a = auth()->attempt($request->only(['password','username']))){
        $user =  AdminUser::where('username',$request->username)->first();
        $token = $user->createToken($user->id);
        return $token->plainTextToken;

    }
    
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user= $request->user();
    // dd($user->allPermissions()->toarray());
    $user->allPermissions()->first(function ($permission) use ($request) {
        return $permission->shouldPassThrough($request);
    });
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
        // Revoke all tokens...
        $user = $request->user();

        $user->tokens()->delete();
        return ['success','成功'];
});


Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
        'device_name' => 'required'
    ]);

    $user = AdminUser::where('username', $request->username)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
// Route::middleware('auth:sanctum')->group(['prefix'=>'auth','middleware'=>'auth:sanctum'],function(){
//     Route::get('me' , )
// });
