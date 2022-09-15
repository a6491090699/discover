<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name'=>'nullable',
            'link'=>'nullable',
            'pay_method'=>'nullable|integer',
            'phone'=>'nullable|phone:CN,mobile',
            'other'=>'nullable',
            'status'=>'nullable|integer',
            'sn'=>'nullable',
            'short_title'=>'nullable',
            'user_id'=>'required',
            // 'signatory'=>'required',
            // 'department'=>'required',
            'sign_start_at'=>'nullable',
            'sign_stop_at'=>'nullable',
            'money_limit'=>'nullable',
            'address'=>'nullable',
            'contact_tel'=>'nullable',
            'contact_qq'=>'nullable',
            'contact_email'=>'nullable',
            'contact_department'=>'nullable',
            'bank_title'=>'nullable',
            'bank_name'=>'nullable',
            'bank_account'=>'nullable',
            'bank_top'=>'nullable',
            'tax_code'=>'nullable',
        ];
    }
}
