<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class MobileOrderRequest extends FormRequest
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
        $productIds = request()->input('product_id', []);
    $quantities = request()->input('qty', []);

    $products = Product::whereIn('id', $productIds)->pluck('quantity', 'id')->toArray();

    return [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone' => 'required|regex:/(0)[0-9]{9}/',
        'province' => 'required',
        'region' => 'required',
        'address' => 'required',
        'notes' => 'nullable',
        'product_id' => 'required|array',
        'product_id.*' => 'required|integer|exists:products,id', 
        'qty' => [
            'required',
            'array',
            'min:1',
            function ($attribute, $value, $fail) use ($products, $productIds, $quantities) {
                foreach ($productIds as $index => $productId) {

                    if (isset($products[$productId]) && $quantities[$index] > $products[$productId]) {
                        $fail(__('messages.The quantity exceeds the available stock for product ID: ' . $productId));
                    } elseif (!isset($products[$productId])) {
                        $fail(__('messages.product_not_found for product ID: ' . $productId));
                    }
                }
            }
        ],
        'user_id' => 'exists:users,id',
        'code' => 'nullable',
    ];
    }

    public function messages()
    {
        return[
            'product_id.exists'=>__('messages.product_not_found'),
            'phone.regex'=>__('messages.phone_regex')
        ];
    }
}
