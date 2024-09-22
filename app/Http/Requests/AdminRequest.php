<?php

namespace App\Http\Requests;

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
        
        if(request()->route()->getActionMethod() == 'store'){
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,except,id',
            'role'=>'required',
            'permission_id'=>'required',
            'password'=>'required|string|min:8|max:64',
            'phone'=>                'unique:users,phone',
            'email' => 'required_if:phone,=,null|nullable|email|unique:users,email,except,id',
        ];
       } 
       if(request()->route()->getActionMethod() == 'update'){
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,except,id',
            'role'=>'required',
            'permission_id'=>'nullable',
            // 'password'=>'required|string|min:8|max:64',

          
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
}