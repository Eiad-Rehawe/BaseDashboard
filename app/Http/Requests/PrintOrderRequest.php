<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintOrderRequest extends FormRequest
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
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required|digits_between:7,14',
            'province' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'print_size_id' => 'required|exists:print_sizes,id', 
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ];
    }
}
