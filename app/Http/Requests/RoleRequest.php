<?php

namespace App\Http\Requests;

use App\Http\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleRequest extends FormRequest
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
        $roleId = $this->route('role');

        return [
            'name_ar' => [
                'required',
                'string',
                Rule::unique('roles')->ignore($roleId),
            ],
            'name_en' => [
                'required',
                'string',
                Rule::unique('roles')->ignore($roleId),
            ],
        ];
    }
}
