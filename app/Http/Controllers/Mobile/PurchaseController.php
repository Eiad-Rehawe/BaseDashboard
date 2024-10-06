<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PurchaseController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:50',
                'phone_number' => 'required|digits_between:7,14',
                'product_name' => 'required|string|max:50',
                'description' => 'string|max:100',
                'price' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // تحقق من نوع وحجم الصورة
            ];
            $messages = [
                'name' => 'The name field is required.',
                'phone_number.required' => 'The Phone number field is required.',
                'phone_number.digits_between' => 'The Phone number must be between 7 and 14 digits.',
                'product_name' => 'The product name field is required.',
                'description' => 'The description field is required.',
                'price' => 'The price field is required.',
                'image.required' => 'The image of product is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'image.max' => 'The image size must not exceed 2MB.'
            ];
    
            $validator = FacadesValidator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return response()->json(["Validation error" => $validator->messages()]);
            }
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                $imageName = time().'.'.$image->getClientOriginalExtension();
    
                $image->move(public_path('uploads/purchases'), $imageName);
    
                Purchase::create([
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'product_name' => $request->product_name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'image' => $imageName
                ]);
            }
    
            return $this->returnSuccess(__('messages.saved success'), 200);
    
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}