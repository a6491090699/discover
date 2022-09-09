<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        dd(request()->all());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'nullable',
            'password'=>'nullable|confirmed',
            'avatar'=>'nullable|image',
            'tel'=>'nullable|string',
            'role_id'=>'nullable|integer',
            'department_id'=>'nullable|integer',
            'company_id'=>'nullable|integer',

        ];
    }
}
