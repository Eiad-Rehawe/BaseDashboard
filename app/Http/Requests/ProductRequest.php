<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(request()->route()->getActionMethod() == 'store'){
        return [
            'name_en'=>'required|string',
            'name_ar'=>'required|string',

            'category_id'=>'required',
            'weight_measurement_id'=>'required_if:weight,!=,null',
            'quantity'=>'required',
            'descrption_ar'=>'required|string',
            'descrption_en'=>'required|string',
            'barcode_id'=>'required|unique:products,barcode_id,except,id',
            'image'=>'required',
        ];
    }
    if(request()->route()->getActionMethod() == 'update'){
        return [
            'name_en'=>'required|string',
            'name_ar'=>'required|string',
            'category_id'=>'required',
            'quantity'=>'required|integer',
            'descrption_ar'=>'string',
            'descrption_en'=>'string',
            'weight_measurement_id'=>'required_if:weight,!=,null',
            // 'barcode_id'=>'unique:products,barcode_id,except,id',

            'image'=>'required_if:image,null',
        ];
    }
    }
}
