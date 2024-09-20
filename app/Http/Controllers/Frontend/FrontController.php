<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ContactRequest;
use App\Models\About;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function about()
    {
        $row = About::first();
        return view('pages.about_us',compact('row'));
    }
    public function get_product($id)
    {
        try {
            $row = (new Product())->with(['files', 'comments' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->where('status', 1)->whereHas('category')->where('id', $id)->first();
            if (!$row) {
                return abort(404, 'not found');
            }
            $related_products = (new Product())->where('status', 1)->where('category_id', $row->category_id)->get();
            $rating = Rating::where('product_id',$id)->where('user_id',auth()->id())->first();
            return view('pages.product', compact('row', 'related_products','rating'));
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function comment(CommentRequest $request)
    {
        try {
            Comment::create([
                'comment' => $request->comment,
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            return response()->json(['title' => trans('frontend.success'), 'message' => trans('frontend.thanks_to_share_your_opinion'), 'status' => 'success', 'redirect' => route('front.product',$request->product_id)]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function shop(Request $request)
    {
        try {

      
        if (request()->ajax()) {
       
            $products_ = [];
            // if (isset(request()->min) && isset(request()->max)) {

            //     $products_ = Product::whereBetween('selling_price', [(int) $request->min, (int) $request->max])
            //         ->orWhereBetween('new_selling_price', [(int) $request->min, (int) $request->max])->whereHas('files')->with('category')->where('status', 1)->orderBy('id', 'desc')->paginate();

            // } else {
                // $query = Product::query();
                $products_ =Product::Filter()->whereHas('files')->where('status',1)->orderBy('id','desc')->paginate();               

               

            // }
            return response()->json([
                'count' => count($products_),
                // 'file'=>asset('images/products/'.$file),
                'html' => view('pages.shop.products', ['products_' => $products_])->render(),
            ]);
        }
   
   
        $products__ = Product::Filter()->whereHas('files')->with('category')->where('status',1)->orderBy('id','desc')->paginate();
        
   
        return view('pages.shop', compact('products__'));
     
    } catch (\Exception $e) {
        dd($e);
      
        return response()->json($e->getMessage(), 500);
    }
    }

    public function featured_cat(Request $request){

        $category = Category::with('children')->where('id', $request->category)->first();
        $childs = $category->children()->pluck('id');
        $products_ =Product::where('category_id', $category->id)->orWhereIn('category_id', $childs)->whereHas('files')->where('status',1)->orderBy('id','desc')->paginate();               
        // dd($products_);
        return response()->json([
            'count' => count($products_),
            // 'file'=>asset('images/products/'.$file),
            'html' => view('pages.index.products', ['products_' => $products_])->render(),
        ]);

    }

    public function compare(Request $request)
    {

        try {
            $product = (new Product())->with('files', 'category', 'weight_measurement')->where('id', $request->id)->first();
            // return response()->json(['product'=>$product]);
            return response()->json([
                'product' => $product,
                'image' => view('pages.shop.product-card', ['product' => $product])->render(),
                'html' => view('pages.compare.table', ['product' => $product])->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function category(Request $request)
    {

        try {
            $products = (new Product())->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->id);
            })->get();

            // return response()->json(['product'=>$product]);
            return response()->json([
                'products' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getProductWhenClickCart($id)
    {
        try {
            $product = (new Product())->where('id', $id)->with('files', 'category')->first();
            return response()->json(['product' => $product]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function checkProduct(Request $request)
{
   
    $product = Product::where('barcode_id', $request->barcode)->first();
    return $product;
    // if ($product) {
    //     return response()->json(['product' => $product]);
    // } else {
    //     return response()->json(['success' => false]);
    // }
}

    public function contact(ContactRequest $request)
    {
        try {
            Contact::create($request->all());
            return response()->json(['title' => 'success', 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('contact_us')]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    public function favourite(Request $request)
    {
        try {
            $product = Favourite::where('product_id',$request->id)->first();
            if(!$product){
                Favourite::create(['product_id'=>$request->id,'user_id'=>auth()->id()]);
                return response()->json([ 'message' => __('messages.Add To Favourite Successfully'),'action'=>'inseart']);

            }if($product){
                $product->delete();
                return response()->json([ 'message' => __('messages.Remove From Favourite Successfully'),'action'=>'delete']);

            }

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    public function favouriteProducts(Request $request)
    {
        try {
            $favs = Favourite::where('user_id',auth()->id())->get();
 
            return view('pages.fav',compact('favs'));

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    
    public function favouriteApiProducts(Request $request)
    {
        try {
         
            $data = Favourite::where('user_id',auth()->id())->with('product')->orderBy('id','desc')->pluck('product_id');
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    
}
