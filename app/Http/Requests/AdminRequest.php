<?php

namespace App\Http\Requests;

use App\Models\Admin;
use DB;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->route()->getActionMethod() == 'store')
        {
            return [
                'name'=>'required',
                'email'=>'required|email|unique:admins',
                'role_id'=>'required',
                'permission_id'=>'required',
                'password'=>'required|string|min:8|max:64',
                'phone'=>                'unique:admins,phone',
            ];
        }
        if(request()->route()->getActionMethod() == 'update')
        {
            $adminId = route('admin');
            return [
                'name'=>'required',
                'email'=>['required','email',Admin::unique('admins')->ignore($adminId)],
                'role'=>'required',
                'permission_id'=>'nullable',
                'password'=>'required|string|min:8|max:64',
            ];
        }
        if(request()->route()->getActionMethod() == 'update_password'){
            return[
                'email'=>'email|unique:admins,email,except,id',
                'address'=>'string',
                'phone'=>'string|unique:admins,phone,except,id'
            ];
        }
    }
    public function messages()
    {
        return [
            'email.unique' => __('validation.unique'),
            'phone.unique' => __('validation.unique')
        ];
    }
}