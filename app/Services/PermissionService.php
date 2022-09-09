<?php
namespace App\Services;

use App\Models\Permission;

class PermissionService extends ModelBaseService
{
    protected $model = Permission::class;

    public function getAllPermissionTree()
    {
        return $this->model::all();
    }

    public function getRolePermissionTree()
    {

    }
}