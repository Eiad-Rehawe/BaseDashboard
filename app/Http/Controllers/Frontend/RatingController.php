<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|numeric|min:1|max:5', // Assuming a 1-5 star rating system
        ]);

        
        $products = Product::where('id',$request->product_id)->get();
        $rating='';
        foreach ($products as $product) {
                $rating =Rating::updateOrCreate(
                    [ 'product_id'=>$product->id,'user_id' => auth()->id()], // Update existing or create new
                    ['rating' => $request->rating]
                );
             
        }
        return response()->json([
            'success' => true,
            'message' => __('messages.Rating saved successfully!'),
            'rating' => $rating
        ]);
    }
}
