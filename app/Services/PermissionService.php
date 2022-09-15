<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;

class PermissionService extends ModelBaseService
{
    protected $model = Permission::class;
    protected $select_value = ['id', 'name'];

    public function getAllPermission($tree = true)
    {
        if ($tree) {
            $list = list_to_tree($this->model::get(['id', 'name', 'parent_id'])->toarray(), 'id', 'parent_id', 'children');
        } else {
            $list = $this->model::get(['id', 'name']);
        }
        return $list;
    }

    public function getRolePermission($role_id, $tree = true)
    {
        $role = Role::find($role_id);
        $permissions_has = $role->permissions()->pluck('id')->toarray();
        $data = $this->model::get(['id', 'name', 'parent_id'])->toarray();
        foreach ($data as $key => $item) {
            if (in_array($item['id'], $permissions_has)) {
                $data[$key]['checked'] = 1;
            } else {
                $data[$key]['checked'] = 0;
            }
        }
        if ($tree) {
            $list = list_to_tree($data, 'id', 'parent_id', 'children');
        } else {
            $list = $data;
        }
        return $list;
    }


    public function getRoutes()
    {
        $prefix = 'api';

        $container = collect();
        // dd(app('router')->getRoutes());
        $routes = collect(app('router')->getRoutes())->map(function ($route) use ($prefix, $container) {
            if (! Str::startsWith($uri = $route->uri(), $prefix) && $prefix) {
                // return;
            }

            if (! Str::contains($uri, '{')) {
                $route = Str::replaceFirst($prefix, '', $uri.'*');

                if ($route !== '*') {
                    $container->push($route);
                }
            }

            return Str::replaceFirst($prefix, '', preg_replace('/{.*}+/', '*', $uri));
        });

        return $container->merge($routes)->filter()->all();
    }

}
