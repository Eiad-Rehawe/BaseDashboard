<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class RegisterCustomerRequest extends FormRequest
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
    public function rules()
    {
        if (request()->route()->getActionMethod() == 'register') {
         

            return [
                'first_name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
                'last_name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
                'email' => 'required_if:phone,=,null|nullable|email|unique:users,email,except,id',
                'password' => 'required|min:8',
                'phone' => 'required_if:email,=,null|nullable|unique:users,phone,except,id|numeric|regex:/(0)[0-9]{9}/',
                'address' => 'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'code'=>'required_with:phone',
                // 'gender'=>'required',
                
            ];
        
        }
        if (request()->route()->getActionMethod() == 'login') {
            return [
                'email_or_phone' => 'required',
                'password' => 'required|min:3',
                

            ];
        }
        if(request()->route()->getActionMethod()=='verifyOtp'){
            return[
                'email' => 'required|string|email|exists:users,email',
                'otp' => 'required|string',
            ];
        }
    }
   

    // protected function failedValidation(Validator $validator)
    // {
    //     throw (new ValidationException($validator))
    //                 ->errorBag($this->errorBag)
    //                 ->redirectTo($this->getRedirectUrl())
    //                 ->status(Response::HTTP_FORBIDDEN);
    // }
    public function messages()
    {
        return [
            'first_name.required' => __('validation.required'),
            'first_name.regex' => __('validation.regex'),

            'first_name.string' => __('validation.string'),
            'last_name.required' => __('validation.required'),
            'last_name.string' => __('validation.string'),
            'last_name.regex' => __('validation.regex'),

            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.unique'),
            'email.regex' => __('messages.regex_email'),

            'password.required' => __('validation.required'),
            'password.min'=>__('validation.min'),
            'address.required'=>__('validation.required'),
            'address.string'=>__('validation.string'),
            'address.regex' => __('validation.regex'),

            'phone.required'=>__('validation.required'),
            'phone.unique'=>__('validation.unique'),
            'phone.regex'=>__('messages.phone_regex'),

            'phone.numeric'=>__('validation.numeric'),
            'code.numeric'=>__('validation.numeric'),
            'code.required'=>__('validation.required'),

        ];
    }
}
