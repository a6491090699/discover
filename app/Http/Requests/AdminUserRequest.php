<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    // public $scene = [
    //     'user.update' => ['username', 'password', 'repassword'],
    //     'user.store' => ['name', 'status'],
    //     'state' => ['status']
    // ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required',
            'name'=>'required',
            'password'=>'required|confirmed',
            // 'password_confirmation '=>'required_with:password',
            'avatar'=>'required|image',
            'tel'=>'required|phone:CN,mobile',
            'role_id'=>'required|integer',
            'department_id'=>'required|integer',
            'company_id'=>'required|integer',

        ];
    }
}
