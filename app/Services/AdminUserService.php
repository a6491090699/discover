<?php

namespace App\Services;

use App\Models\AdminUser;
use Illuminate\Http\UploadedFile;

class AdminUserService extends ModelBaseService
{
    
    protected $model = AdminUser::class;


    public function create($data)
    {
        $user = new $this->model();
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        if (isset($data['avatar']) && !empty($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
            $data['avatar'] = $data['avatar']->store('avatar','public');
        }
        $user->fill($data)->save();
        return $user;
    }

    public function update($id, $data, $isadmin = false)
    {
        if ($isadmin) {
            $updates = collect($data)->only(['username', 'password', 'avatar', 'role_id']);
        } else {
            $updates = collect($data)->only(['username', 'password', 'avatar']);
        }
        if (isset($updates['password']) && !empty($updates['password'])) {
            $updates['password'] = bcrypt($updates['password']);
        }
        return $this->model::where('id', $id)->update($updates);
    }


}
