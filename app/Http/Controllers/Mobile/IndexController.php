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
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
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
                ->where('status', 1)
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
    public function ShowProductsByCategoryId($categoryId = null)
    {
        try {
            $lang = request()->header('Accept-Language');

            $data = (new Product())
            ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
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
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
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
                $q->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
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
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
                ->with('files')->with('ratings', function ($q) {
                $q->select('product_id', DB::raw('AVG(rating) as rating'))
                    ->groupBy('rating', 'product_id');
            })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })->where('id', $id)->where('status', 1)->with('weight_measurement', function ($q) use ($lang) {
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

            $lang = request()->header('Accept-Language');
            $data = (new Product())
                ->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
                ->Filter()
                ->with('files')
                ->with('weight_measurement', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                })
                ->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('rating', 'product_id');
                })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })

                ->where('status', 1)
                ->get();
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }

    public function featured_cat(Request $request)
    {
        try {
            $lang = request()->header('Accept-Language');
            $category = Category::with('children')->where('id', $request->category)->first();

            $childs = $category->children()->pluck('id');
            $data = Product::select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
                ->where('category_id', $category->id)->orWhereIn('category_id', $childs)->whereHas('files')
                ->with('ratings', function ($q) {
                    $q->select('product_id', DB::raw('AVG(rating) as rating'))
                        ->groupBy('rating', 'product_id');
                })->with('category', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                    $q->select('id', "name_$lang as name");
                });
            })
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
    public function selectProduct()
    {
        $lang = request()->header('Accept-Language');

        $product = Product::select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
            ->with('files')->with('ratings', function ($q) {
            $q->select('product_id', DB::raw('AVG(rating) as rating'))
                ->groupBy('rating', 'product_id');
        })->with('category', function ($q) use ($lang) {
            $q->select('id', "name_$lang as name", 'parent_id')->with('parent', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name");
            });
        });
        return $product;
    }

    public static function selectCategory()
    {
        $lang = request()->header('Accept-Language');
        $data = (new Category())
            ->select('id', "name_$lang as name", 'parent_id')
            ->with('parent', function ($q) use ($lang) {
                $q->select('id', "name_$lang as name", 'parent_id');
            })->with('files');
        return $data;
    }
    public function AddOrder(MobileOrderRequest $request)
    { 
        try {
            DB::beginTransaction();
            $statusCode = '';
            $msg = '';
            $qty = [];
            $pp = [];
            // $products_id = explode(',', $request->product_id);
            // $quantity = explode(',', $request->qty);
            foreach ($request->product_id as $p) {
                array_push($pp, $p);

            }
            foreach ( $request->qty as $q) {
                array_push($qty, $q);

            }

            $products = Product::whereIn('id', (array) $pp)->get();
            $total = 0;
            foreach ($products as $index => $product) {
                $product = Product::where('id', $pp[$index])->first();

                $total = $product->price() * (int) $qty[$index];
            }
            
            if (count($products) > 0) {
                if (!empty($request->code)) {
                
                    $coupon = Coupon::where('code', $request->code)->first();
                   
                    if (isset($coupon) && !empty($coupon)) {
                      
                        $copon_user = CouponUser::where('coupon_id', $coupon->id)->first();

                        if ($copon_user != null && $copon_user->user_id == auth()->user()->id || $copon_user != null && $copon_user->user_id == 0) {

                            $used_coupon = $coupon->coupon_used->where('user_id', auth()->id())->first();

                            if (empty($used_coupon)) {
                                if ($coupon->value < $total) {
                                    if ($coupon->expired_at > now()) {
                                        if (!empty($copon_user)) {
                                            $order = Order::create([
                                                'user_id' => auth()->id(),
                                                'coupon_id' => $coupon->id,

                                                'first_name' => $request->first_name,
                                                'last_name' => $request->last_name,
                                                'phone' => $request->phone,
                                                'email' => $request->email,
                                                'address_1' => $request->address_1,
                                                'address_2' => $request->address_2,
                                                'country' => $request->country,
                                                'city' => $request->city,
                                                'notes' => $request->notes,
                                                'status' => 'Checkout',
                                                'total' => $total,
                                                'total_after_discount' => $total - $coupon->value,

                                                'coupon_value' => $coupon->value ?? null,
                                                'order_date' => now(),
                                            ]);
                                            UsedCoupon::create([
                                                'coupon_id' => $coupon->id,
                                                'user_id' => auth()->id(),
                                                'order_id' => $order->id,
                                            ]);
                                            foreach ($products as $index => $product) {
                                                $request->header('Accept-Language') == 'ar' ? $name = $product->name_ar : $name = $product->name_en;

                                                OrderDetail::updateOrCreate(
                                                    ['product_id' => $product->id,

                                                        'order_id' => $order->id,
                                                    ], [
                                                        'product_name' => $name,
                                                        'price' => $product->price(),
                                                        'quantity' => (int) $qty[$index],
                                                    ]);

                                            }
                                            $msg = __('messages.add order success');
                                            $statusCode = 200;

                                        } else {

                                            $msg = __('messages.coupon not exist');
                                            $statusCode = 404;
                                        }
                                    } else {

                                        $msg = __('messages.your coupon is expired');
                                        $statusCode = 403;
                                    }
                                } else {
                                    $msg = __('messages.your invoice total less than coupon value');
                                    $statusCode = 403;
                                }

                            } else {

                                $msg = __('messages.your coupon have been used recently');
                                $statusCode = 403;
                            }

                        } else {
                     
                            $msg = __('messages.your coupon is not correct');
                            $statusCode = 403;
                        }

                    } else if (!isset($coupon)) {

                        $msg = __('messages.coupon not exist');
                        $statusCode = 404;

                    }
                } elseif (empty($request->code)) {
                    $order = Order::create([
                        'user_id' => auth()->id(),
                        'coupon_id' => null,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'address_1' => $request->address_1,
                        'address_2' => $request->address_2,
                        'country' => $request->country,
                        'city' => $request->city,
                        'notes' => $request->notes,
                        'status' => 'Checkout',
                        'total' => $total,
                        'total_after_discount' => null,

                        'coupon_value' => null,
                        'order_date' => now(),
                    ]);

                    foreach ($products as $index => $product) {
                        $request->header('Accept-Language') == 'ar' ? $name = $product->name_ar : $name = $product->name_en;
                        $order_d = OrderDetail::updateOrCreate(
                            ['product_id' => $product->id,

                                'order_id' => $order->id,
                            ], [
                                'product_name' => $name,
                                'price' => $product->price(),
                                'quantity' => (int) $qty[$index],
                            ]);

                    }

                    $msg = __('messages.add order success');
                    $statusCode = 200;
                }
            } else {

                $msg = __('messages.please add products to your cart');
                $statusCode = 500;
            }
            DB::commit();
            if ($statusCode == 200) {
                return $this->returnSuccess($msg, 200);

            } else {
                return $this->returnError( $msg, $statusCode);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json( $e->getMessage());
        }
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
        $data = About::select("descrption_$lang as descrption", 'image')->first();
        return $this->returnData($data, true, 200);
    }

    public function favourite(Request $request)
    {
        try {
            $product = Favourite::where('product_id', $request->id)->first();
            if (!$product) {
                Favourite::create(['product_id' => $request->id, 'user_id' => auth()->id()]);
                return $this->returnSuccess(__('messages.Add To Favourite Successfully'), 200);

            }if ($product) {
                $product->delete();
                return $this->returnSuccess(__('messages.Remove From Favourite Successfully'), 200);

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
                $q-> select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption")
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
            })
           ->orderBy('id', 'desc')->get();

            return $this->returnData($data, true, 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

}
