<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PosterRequest extends FormRequest
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
        
        if (request()->route()->getActionMethod() == 'store') {
            return [
                'product_id' => 'nullable|exists:products,id',
                'category_id' => 'nullable|exists:categories,id',
                // 'language_id'=>'required',
                'price_discount' => "required_if:Percentage_discount,=,null",
                'Percentage_discount' => 'required_if:price_discount,=,null',
            ];
        }
        if (request()->route()->getActionMethod() == 'update') {
            return [
                'product_id' => 'nullable|exists:products,id',
                'category_id' => 'nullable|exists:categories,id',
                // 'language_id'=>'required',

            ];
        }
        

    }
}
