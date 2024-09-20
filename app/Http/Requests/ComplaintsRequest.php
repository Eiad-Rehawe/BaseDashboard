<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintsRequest extends FormRequest
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
        if(request()->route()->getActionMethod() == 'storePublicOrEmployeeComplaiment'){

        return [
            'complaint_text'=>'required',
            'cause_problem'=>'string|nullable',
            'employee_name'=>'required_if:status,=,0|nullable|exists:admins,name',
            'cause_problem'=>'string|required'

        ];
    }
    if(request()->route()->getActionMethod() == 'store' || request()->route()->getActionMethod()=='storeProductComplaimen'){
        return [
            'complaint_text'=>'required',
            'product_id'=>'exists:products,id',
           

        ];
    }
    
    }
}
