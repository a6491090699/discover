<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PubController extends Controller
{
    //获取用户菜单
    public function base(Request $request)
    {
        $permissions = $request->user()->allPermissions();
        $userinfo = $request->user();
        //审批消息 todo

        return response()->json(['success' => 1, 'data' => compact('permission', 'userinfo')]);
    }
    public function menu(Request $request)
    {
        $permissions = $request->user()->allPermissions();
        return response()->json(['success' => 1, 'data' => $permissions]);
    }
}
