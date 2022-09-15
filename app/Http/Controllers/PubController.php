<?php

namespace App\Http\Controllers;

use App\Services\AdminUserService;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class PubController extends Controller
{
    //获取用户菜单
    public function base(Request $request)
    {
        $permissions = $request->user()->allPermissions();
        $userinfo = $request->user();
        //审批消息 todo

        return $this->_success(compact('permission', 'userinfo'));
    }
    public function menu(Request $request)
    {
        $permissions = $request->user()->allPermissions();
        return $this->_success($permissions);
    }

    public function roles()
    {
        $list = app(RoleService::class)->selectItem();
        return $this->_success($list->toArray());
    }

    public function permissions()
    {
        // $list = app(PermissionService::class)->selectItem();
        $role = request()->query('role', 0);
        if ($role) {
            $tree = app(PermissionService::class)->getRolePermission($role);
        } else {
            $tree = app(PermissionService::class)->getAllPermission();
        }
        return $this->_success($tree);
    }

    public function users()
    {
        $list = app(AdminUserService::class)->selectItem();
        return $this->_success($list->toArray());
    }

    public function urls()
    {
        $list = app(PermissionService::class)->getRoutes();
        return $this->_success($list);
    }
}
