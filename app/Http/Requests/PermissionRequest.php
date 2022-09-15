<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id'=>'required|integer',
            'slug'=>'required|string',
            'name'=>'required|string',
            'http_method'=>'nullable|string',
            'http_path'=>'nullable|string',
        ];
    }
}
