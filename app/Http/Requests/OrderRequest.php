<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
    // protected function failedValidation(Validator $validator)
    // {
    //     if ($this->expectsJson()) {
    //         $errors = (new ValidationException($validator))->errors();
    //         $title = __('messages.error');
    //         $status = 'error';
    //         $msg ='';
    //         $redirect = route('checkout');
    //        foreach($errors as $key=>$error){
    //         $qty = [];
    //         $qty = explode(',',request()->input('qty'));
    //         $product_id = [];
    //         $product_id = explode(',',request()->input('product_id'));
    //         $products = Product::whereIn('id',$product_id)->get();
    //         foreach($qty as $index=>$q){
    //            foreach($products as $product){
    //             if($key == 'qty' && $q> $product->quantity){

    //                 $msg = __('messages.The quantity exceeds the available stock'.' exists:'.$product->quantity);
    //             }else{

    //                 $msg = $error[0];
    //             }
    //            }
    //         }
    //        }
    //         return throw new HttpResponseException(

    //              response()->json(['title' => $title, 'message' => $msg, 'status' => $status,'redirect'=>$redirect])

    //             // response()->json(['data' => $errors], 422)
    //         );
    //     }

    //     parent::failedValidation($validator);
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = request()->route()->getActionMethod();
    
        switch ($method) {
            case 'storeOrder':
                return [
                    'first_name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
                    'last_name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
                    'phone' => 'required|regex:/(0)[0-9]{9}/',
                    'email' => 'required|email',
                    'address_1' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                    'address_2' => 'nullable|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                    'city' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                    'notes' => 'nullable|regex:/^[a-zA-Z0-9]+$/',
                    'user_id' => 'exists:users,id',
                    'coupon' => 'nullable|exists:coupons,code',
                    
                    'product_id' => 'required|array',
                    'product_id.*' => 'required|integer|exists:products,id',
                    'qty' => [
                        'required', 'array', 'min:1',
                        function ($attribute, $value, $fail) {
                            $index = explode('.', $attribute)[1]; // استخلاص الـ index
                            $product = Product::find(request()->product_id[$index]); // البحث عن المنتج المطابق
                            if ($product && $value > $product->quantity) {
                                $fail(__('messages.The quantity exceeds the available stock'));
                            }
                        }
                    ],
                ];
    
            case 'updateOrder':
                return [
                    'first_name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
                    'last_name' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
                    'phone' => 'required|regex:/(0)[0-9]{9}/',
                    'email' => 'required|email',
                    'address_1' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                    'address_2' => 'nullable|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                    'city' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                    'notes' => 'nullable|regex:/^[a-zA-Z0-9]+$/',
                    'user_id' => 'exists:users,id',
                    'coupon' => 'nullable|exists:coupons,code',
                    'qty' => [
                        'required', 'min:1',
                        function ($attribute, $value, $fail) {
                            $product = Product::find(request()->input('product_id')); // البحث عن المنتج
                            if ($product && $value > $product->quantity) {
                                $fail(__('messages.The quantity exceeds the available stock'));
                            } elseif (!$product) {
                                $fail(__('messages.product_not_found'));
                            }
                        }
                    ],
                ];
    
            case 'addProductsToOrder':
                return [
                    'qty' => 'required|array|min:1',
                ];
    
            case 'deleteProductOrder':
                return [
                    'order_id' => 'required|integer|exists:orders,id',
                    'product_id' => 'required|integer|exists:order_details,product_id',
                ];
    
            case 'deleteOrder':
                return [
                    'order_id' => 'required|integer|exists:orders,id',
                ];
                
            default:
                return [];
        }
    }
    

    public function messages()
    {
        return [
            'email.regex' => __('messages.regex_email'),
            'phone.regex' => __('messages.phone_regex'),

        ];
    }
}
