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
        $pp = [];
        foreach (request()->product_id as $p) {
            array_push($pp, $p);

        }
        $products = Product::whereIn('id', (array) $pp)->pluck('quantity')->toArray();
       
        return [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone'=>'required|regex:/(0)[0-9]{9}/',
            'email'=>'required|email',
            'address_1'=>'required',
            'address_2'=>'nullable',
            'country'=>'required',
            'city'=>'required',
            'notes'=>'nullable',
            'product_id'=>'required|exists:products,id',
            'user_id'=>'exists:users,id',
            'code'=>'nullable|exists:coupons,code',
            'qty'=>['array','min:1'
            , function ($attribute, $value, $fail) use ($products) {
                
               if($products){
                for($i=0; $i<count($products); $i++){

                    if ($value[$i] > $products[$i]) {
                        $fail(__('messages.The quantity exceeds the available stock'));
                    }
                }
              
               }
               else{
                $fail(__('messages.product_not_found'));
               }
            }
            ]
            
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
