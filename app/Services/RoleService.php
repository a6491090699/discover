<?php

namespace App\Services;

use App\Models\Role;

class RoleService extends ModelBaseService
{

    protected $model = Role::class;
    protected $select_value = ['id' , 'name'];

    public function create($data)
    {
        $new = parent::create($data);
        if (isset($data['permission_ids']) && $data['permission_ids']) {
            $new->permissions()->attach($data['permission_ids']);
        }
    }

    public function delete($id)
    {
        $role = $this->model::find($id);
        $role->permissions()->detach();
        return parent::delete($id);
    }

    public function getRolePermission($role_id , $tree = false)
    {
        
    }
    
    
}
