<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name'=>'required',
            'link'=>'required',
            'pay_method'=>'required|integer',
            'phone'=>'required|phone:CN,mobile',
            'other'=>'nullable',
            'status'=>'required|integer',
            'sn'=>'required',
            'short_title'=>'required',
            'user_id'=>'required',
            // 'signatory'=>'required',
            // 'department'=>'required',
            'sign_start_at'=>'required',
            'sign_stop_at'=>'required',
            'money_limit'=>'required',
            'address'=>'required',
            'contact_tel'=>'required',
            'contact_qq'=>'required',
            'contact_email'=>'required',
            'contact_department'=>'required',
            'bank_title'=>'required',
            'bank_name'=>'required',
            'bank_account'=>'required',
            'bank_top'=>'required',
            'tax_code'=>'required',
        ];
    }
}
