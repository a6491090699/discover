<?php

namespace App\Services;

use App\Models\AdminUser;
use App\Services\Support\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminUserService extends ModelBaseService
{

    protected $model = AdminUser::class;
    protected $select_value = ['id','name'];


    public function create($data)
    {
        $user = new $this->model();
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        if (isset($data['avatar']) && !empty($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
            // if (isset($data['avatar']) && !empty($data['avatar']) ) {
            $data['avatar'] = $data['avatar']->store('avatar', 'public');
        }
        $user->fill($data)->save();
        return $user;
    }

    public function update($id, $data, $isadmin = false)
    {
        if ($isadmin) {
            $updates = collect($data)->only(['username', 'password', 'avatar', 'role_id']);
        } else {
            $updates = collect($data);
        }
        if (isset($updates['password']) && !empty($updates['password'])) {
            $updates['password'] = bcrypt($updates['password']);
        }

        //base64
        if (isset($data['avatar64']) && !empty($data['avatar64'])) {
            $images = app(FileService::class)->uploadBase64($data['avatar64'] ,'avatar');
            if($images){
                $updates['avatar'] = $images;
            }
            unset($updates['avatar64']);
        }
        return $this->model::where('id', $id)->update($updates->toArray());
    }

    public function delete($id)
    {
        $role = $this->model::find($id);
        $role->roles()->detach();
        return parent::delete($id);
    }



}
