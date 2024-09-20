<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->route()->getActionMethod() == 'register') {
            return [
                'name' => 'required',
                'email' => 'email|required|unique:users,email,except,id|regex:/^[a-zA-Z0-9._%+-]+@example\.com$/',
                'password' => 'required|min:3',
                'phone' => 'required|unique:users,phone,except,id',
                'address' => 'required|string',

            ];
        }
        if (request()->route()->getActionMethod() == 'login') {
            return [
                'email_or_phone' => 'required',
                'password' => 'required|min:3',
                

            ];
        }
    }

    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ]));
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.unique'),
            'password.required' => __('validation.required'),
        ];
    }
}
