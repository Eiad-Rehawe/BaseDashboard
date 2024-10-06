<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ComplaintsRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\MobileOrderRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Services\ComplaintsService;
use App\Models\About;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Complaints;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Poster;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Size;
use App\Models\UsedCoupon;
use App\Notifications\addOrder;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    use ResponseTrait;
    public function getProducts()
    {
        try {
            $lang = request()->header('Accept-Language');
            $data = (new Product())
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption", "size_id")
                ->with('files')
                ->with('weight_measurement', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                })->with('category', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                        $q->select('id', "name_$lang as name");
                    });
                })
                ->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('product_id');
                })
                ->with('size:id,size')
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
    
            $filteredData = $data->map(function ($product) {
                $productArray = $product->toArray();
                foreach ($productArray as $key => $value) {
                    if (is_array($value) && empty($value)) {
                        unset($productArray[$key]);
                    }
                }
                return $productArray;
            });

            return response()->json(['status' => true, 'data' => $filteredData], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function ShowProductsByCategoryId($categoryId = null)
    {
        try {
            $lang = request()->header('Accept-Language');

            $data = (new Product())
            ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption",'size_id')
            ->with('files')
            ->with('weight_measurement', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name");
            })
            ->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })
            ->with('ratings', function ($q) {
                $q->select('product_id', DB::raw('AVG(rating) as rating'))
                    ->groupBy('product_id');
            })
            ->with('size:id,size')
            ->where('status', 1)
            ->when($categoryId, function ($q) use ($categoryId) {
                return $q->where('category_id', $categoryId); // تصفية بناءً على category_id إذا تم تمريره
            })
            ->orderBy('id', 'desc')
            ->get();

            // معالجة البيانات لإزالة الحقول الفارغة
            $filteredData = $data->map(function ($product) {
                $productArray = $product->toArray();
                foreach ($productArray as $key => $value) {
                    if (is_array($value) && empty($value)) {
                        unset($productArray[$key]);
                    }
                }
                return $productArray;
            });

            return response()->json(['status' => true, 'data' => $filteredData], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function min_max()
    {
        try {
            $products = Product::where('status', 1)->get();
            $min = '';
            $max = '';
            foreach ($products as $product) {
                if (request('category')) {
                    if ($product->new_selling_price == null) {
                        $min = $products->where('category_id', request('category'))->min('selling_price');
                        $max = $products->where('category_id', request('category'))->max('selling_price');
                    } else {
                        $min = $products->where('category_id', request('category'))->min('new_selling_price');
                        $max = $products->where('category_id', request('category'))->max('new_selling_price');
                    }
                } else {
                    if ($product->new_selling_price == null) {
                        $min = $products->min('selling_price');
                        $max = $products->max('selling_price');
                    } else {
                        $min = $products->min('new_selling_price');
                        $max = $products->max('new_selling_price');
                    }
                }
            }
            return response()->json(['status' => true, 'min' => $min, 'max' => $max], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function latest_products()
    {
        try {
            $lang = request()->header('Accept-Language');
            $data = (new Product())
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption",'size_id')
                ->with('files')->with('weight_measurement', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name");
            })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })
                ->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('product_id');
            })
                ->with('size:id,size')
                ->where('status', 1)->orderBy('id', 'desc')->take(10)->latest()->get();
            $filteredData = $data->map(function ($product) {
                $productArray = $product->toArray();
                foreach ($productArray as $key => $value) {
                    if (is_array($value) && empty($value)) {
                        unset($productArray[$key]);
                    }
                }
                return $productArray;
            });

            return response()->json(['status' => true, 'data' => $filteredData], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function offer_categories()
    {
        try {
            $lang = request()->header('Accept-Language');

            $data = Poster::select('id', 'category_id', 'Percentage_discount')->with(['category' => function ($q) use ($lang) {
                $q->with('files')->select('id', "name_$lang as name", 'parent_id')
                    ->with('parent', function ($q) use ($lang) {
                        $q->select('id', "name_$lang as name", 'parent_id');
                    });
            }])->whereNull('price_discount')->whereNull('product_id')
            // ->whereHas('product',function($q) use($lang){
            //     $q->select('id',"name_$lang as name", 'wight','category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
            //     ->with('files')->with('ratings',function($q){
            //         $q->select('product_id',DB::raw('AVG(rating) as rating'))
            //         ->groupBy('rating','product_id');
            //     })->with('category',function($q)use($lang){
            //         $q->select('id',"name_$lang as name",'parent_id')->with('parent',function($q) use($lang){
            //             $q->select('id',"name_$lang as name");
            //         });
            //     });
            // })
                ->where('status', 1)->get();
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function offer_products()
    {
        try {
            $lang = request()->header('Accept-Language');

            $data = Poster::select('id', 'product_id', 'price_discount')->with(['product' => function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption", 'size_id')
                    ->with('files')->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('rating', 'product_id');
                })->with('category', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                        $q->select('id', "name_$lang as name");
                    });
                });
                $q->with('weight_measurement', function ($q) use ($lang) {
                    $q->select('id', "name_$lang");
                });
                $q->with('size:id,size');
            }])
                ->whereNull('Percentage_discount')->whereNull('category_id')
                ->where('status', 1)->get();
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function contact(ContactRequest $request)
    {
        try {
            Contact::create($request->all());
            return $this->returnSuccess(__('messages.saved success'), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function showProduct($id)
    {
        try {
            $lang = request()->header('Accept-Language');
            $data = (new Product())
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption", 'size_id')
                ->with('files')->with('ratings', function ($q) {
                $q->select('product_id', DB::raw('AVG(rating) as rating'))
                    ->groupBy('rating', 'product_id');
            })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })->where('id', $id)->where('status', 1)->with('weight_measurement', function ($q) use ($lang) {
                $q->select('id', "name_$lang");
            })->with('size:id,size')->first();

            if (!$data) {
                return $this->returnError(__('messages.not_found'), 404);
            }
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function showProductByBarcode($id)
    {
        try {
            $lang = request()->header('Accept-Language');
            $data = (new Product())
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
                ->with('files')->with('ratings', function ($q) {
                $q->select('product_id', DB::raw('AVG(rating) as rating'))
                    ->groupBy('rating', 'product_id');
            })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })->where('barcode_id', $id)->where('status', 1)->with('weight_measurement', function ($q) use ($lang) {
                $q->select('id', "name_$lang");
            })->first();
            if (!$data) {
                return $this->returnError(__('messages.not_found'), 404);
            }
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getCategories()
    {
        try {
            $lang = request()->header('Accept-Language');
            $data = (new Category())
                ->select('id', "name_$lang as name", 'parent_id')
                ->with('child', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name", 'parent_id');
                })->with('files')
                ->whereHas('products')
                ->where('status', 1)->orderBy('id', 'desc')->get();

            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function filterProducts(Request $request)
    {
        try {
            $lang = $request->header('Accept-Language');
            
            $products = Product::select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption", 'size_id')
                ->Filter()
                ->with('files')
                ->with('weight_measurement', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                })
                ->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('product_id');
                })
                ->with('category', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name", 'parent_id')
                    ->with('parent', function ($q) use ($lang) {
                        $q->select('id', "name_$lang as name");
                    });
                })
                ->with('size:id,size')
                ->where('status', 1);
    
            if ($request->filled('category_id')) {
                $products->where('category_id', $request->category_id);
            }
    
            if ($request->filled('min') && $request->filled('max')) {
                $products->whereRaw('COALESCE(new_selling_price, selling_price) BETWEEN ? AND ?', [$request->min, $request->max]);
            }
    
            $data = $products->get();
            
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function featured_cat(Request $request)
    {
        try {
            $lang = request()->header('Accept-Language');
            $category = Category::with('children')->where('id', $request->category)->first();

            $childs = $category->children()->pluck('id');
            $data = Product::select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption", 'size_id')
                ->where('category_id', $category->id)->orWhereIn('category_id', $childs)->whereHas('files')
                ->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('rating', 'product_id');
                })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })
            ->with('size:id,size')
            ->where('status', 1)->orderBy('id', 'desc')->paginate();
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }

    public function storeProductComplaimen(ComplaintsRequest $request, ComplaintsService $service)
    {
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) {
                return $this->throwException($row);
            }

            return $this->returnSuccess(__('messages.saved success'), 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }

    public function storePublicOrEmployeeComplaiment(ComplaintsRequest $request)
    {
        try {
            Complaints::create(array_merge($request->except('customer_id', 'complaint_date'), ['customer_id' => auth()->id(), 'complaint_date' => now()]));

            return $this->returnSuccess(__('messages.saved success'), 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }
    // public function selectProduct()
    // {
    //     $lang = request()->header('Accept-Language');

    //     $product = Product::select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
    //         ->with('files')->with('ratings', function ($q) {
    //         $q->select('product_id', DB::raw('AVG(rating) as rating'))
    //             ->groupBy('rating', 'product_id');
    //     })->with('category', function ($q) use ($lang) {
    //         $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
    //             $q->select('id', "name_$lang as name");
    //         });
    //     });
    //     return $product;
    // }

    // public static function selectCategory()
    // {
    //     $lang = request()->header('Accept-Language');
    //     $data = (new Category())
    //         ->select('id', "name_$lang as name", 'parent_id')
    //         ->with('parent', function ($q) use ($lang) {
    //             $q->select('id', "name_$lang as name", 'parent_id');
    //         })->with('files');
    //     return $data;
    // }


    public function AddOrder(MobileOrderRequest $request)
    { 
        try {
            DB::beginTransaction();
            
            $products = Product::whereIn('id', $request->product_id)->get();
            if ($products->isEmpty()) {
                return $this->returnError(__('messages.please add products to your cart'), 500);
            }
            
            $total = 0;
            for ($i = 0; $i < count($products); $i++) {
                $product = $products[$i];
                $total += ($product->new_selling_price == null ? $product->selling_price : $product->new_selling_price) * ((int)$request->qty[$i]);
            }

            $coupon = null;
            if (!empty($request->code)) {
                $coupon = $this->applyCoupon($request->code, $total);
                if (is_string($coupon)) {
                    return $this->returnError($coupon, 403); 
                }
            }
            
            $order = Order::create([
                'user_id' => auth()->id(),
                'coupon_id' => $coupon->id ?? null,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'province' => $request->province,
                'region' => $request->region,
                'notes' => $request->notes,
                'status' => 'Checkout',
                'total' => $total,
                'total_after_discount' => $coupon ? ($total - $coupon->value) : null,
                'coupon_value' => $coupon->value ?? null,
                'order_date' => now(),
            ]);
            
            foreach ($products as $index => $product) {
                $productName = $request->header('Accept-Language') == 'ar' ? $product->name_ar : $product->name_en;
                OrderDetail::updateOrCreate(
                    ['product_id' => $product->id, 'order_id' => $order->id],
                    [
                        'product_name' => $productName,
                        'price' => $product->price(),
                        'quantity' => (int)$request->qty[$index],
                    ]
                );
            }
            
            if ($coupon) {
                UsedCoupon::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                ]);
            }
            
            DB::commit();
            return $this->returnSuccess(__('messages.add order success'), 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }


private function applyCoupon($code, $total)
{
    $coupon = Coupon::where('code', $code)->first();
    if (!$coupon) {
        return __(key: 'messages.coupon not exist');
    }
    
    if ($coupon->expired_at <= now()) {
        return __('messages.your coupon is expired');
    }
    
    if ($coupon->value >= $total) {
        return __('messages.your invoice total less than coupon value');
    }
    $usedCoupon = UsedCoupon::where('coupon_id',$coupon->id)->first();
    
    if ($usedCoupon){
        return __('messages.your coupon have been used recently');
    }

    $couponUser = CouponUser::where('coupon_id', $coupon->id)
                            ->where(function ($query) {
                                $query->where('user_id', auth()->id())
                                    ->orWhere('user_id', 0);
                            })
                            ->first();
    
    if (!$couponUser) {
        return __('messages.you can\'t use this coupon');
    }
    
    return $coupon;
}


    public function cancelOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update(['status' => 'canceled']);
            return $this->returnSuccess(__('messages.cancel order success'), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
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
            return $this->returnSuccess(__('messages.thanks_to_share_your_opinion'), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getComments()
    {
        try {
            $lang = request()->header('Accept-Language');

            $data = Comment::select('*')->with('product', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
                    ->with('files')->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('rating', 'product_id');
                })->with('category', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                        $q->select('id', "name_$lang as name");
                    });
                })->where('status', 1)->with('weight_measurement', function ($q) use ($lang) {
                    $q->select('id', "name_$lang");
                });

            })->with('user',function($q){
                $url = explode('/',request()->url());     
                $q->select('users.*',
                DB::raw('CASE WHEN gender = 1 THEN "male" ELSE "female" END as gender_text'));
            })->get();
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }
    public function review(ReviewRequest $request)
    {

        try {
            $product = Product::where('id', $request->product_id)->first();
            $rating = '';

            $rating = Rating::updateOrCreate(
                ['product_id' => $product->id, 'user_id' => auth()->id()], // Update existing or create new
                ['rating' => $request->rating]
            );

            return $this->returnSuccess(__('messages.Evaluation completed successfully'), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function about()
    {
        $lang = request()->header('Accept-Language');
        $data = About::select("descrption_$lang as descrption", 'image','phone_number','Shop_name','Company_name')->first();
        return $this->returnData($data, true, 200);
    }

    public function favourite(Request $request)
    {
        try {
            $product = Favourite::where('product_id', $request->id)->first();
            if (!$product) {
                Favourite::create(['product_id' => $request->id, 'user_id' => auth()->id()]);
                $response = [
                    'status' => true,
                    'msg'=>__('messages.Add To Favourite Successfully'),
                    'fav'=>true
                ];
                return response()->json($response,200);
            }
            if ($product) {
                $product->delete();
                $response = [
                    'status' => true,
                    'msg'=>__('messages.Remove From Favourite Successfully'),
                    'fav'=>false
                ];
                return response()->json($response,200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function favouriteProducts(Request $request)
    {
        try {
            $lang = request()->header('Accept-Language');

            $fav = Favourite::where('user_id', auth()->id())->with('product')->first();
            $data = Favourite::where('user_id', auth()->id())->with('product',function($q) use($lang){
                $q-> select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption", 'size_id')
                ->with('files')->with('ratings', function ($q) {
                $q->select('product_id', DB::raw('AVG(rating) as rating'))
                    ->groupBy('rating', 'product_id');
            })
            ->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })
            ->where('status', 1)
            ->with('weight_measurement', function ($q) use ($lang) {
                $q->select('id', "name_$lang");
            })
            ->with('size:id,size');
            })
            ->orderBy('id', 'desc')->get();

            return $this->returnData($data, true, 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function SellProduct(Request $request) {
        
    }
}