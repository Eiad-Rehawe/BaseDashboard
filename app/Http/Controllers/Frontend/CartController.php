<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UsedCoupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.cart');
    }

    public function checkoutPage()
    {
        $status = '';
        if(!empty(auth()->id())){
           $coupons= CouponUser::where('user_id',auth()->id())->orWhere('user_id',null)->get();
           $coupons =$coupons->toArray();
            if(!empty($coupons)){
                $status ='true';
            }else{
                $status = 'false';
            }
        }
       
        return view('pages.checkout',compact('status'));
    }
   
    public function get_coupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->cc)->first();
        $case = '';
        if (isset($coupon)) {
            $case = 1;
        } else {
            $case = 2;
        }
        return response()->json(['coupon' => $coupon, 'case' => $case]);

    }
 

    public function storeOrder(OrderRequest $request)
    {
        
        try {
            DB::beginTransaction();
            $title = '';
            $status = '';
            $msg = '';
            $redirect = '';
            $qty = [];
            $pp = [];
            $q=0;
            $products_id = explode(',', $request->product_id);
            $product='';
            
            $quantity = explode(',', $request->qty);
            foreach ($products_id as $p) {
                array_push($pp, $p);

            }
            foreach ($quantity as $q) {
                array_push($qty, $q);

            }
            // for($i=0; $i<count($qty); $i++){
            //     $q =$qty[$i];
            //     dd($q);  
            // }
       
            $products = Product::whereIn('id', (array) $pp)->get();
         
            if (count($products) > 0) {
            
                if (!empty($request->code)) {
                    $coupon = Coupon::where('code', $request->code)->first();
               
                    if (isset($coupon) && !empty($coupon)) {
                        $copon_user = CouponUser::where('coupon_id', $coupon->id)->first();
                        if (isset($copon_user) && $copon_user->user_id == auth()->id() || $copon_user->user_id == 0) {
                            $used_coupon = UsedCoupon::where('coupon_id', $coupon->id)->where('user_id', auth()->id())->first();

                            if (empty($used_coupon)) {
                                if($coupon->value < $request->total){
                                    
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
                                                
                                                'city' => $request->city,
                                                'notes' => $request->notes,
                                                'status' => 'Checkout',
                                                'total' => $request->total,
                                                'total_after_discount' => $request->total - $coupon->value,
    
                                                'coupon_value' => $coupon->value ?? null,
                                                'order_date' => now(),
                                            ]);
                                            UsedCoupon::create([
                                                'coupon_id' => $coupon->id,
                                                'user_id' => auth()->id(),
                                                'order_id' => $order->id,
                                            ]);
                                            foreach ($products as $index => $product) {
    
                                                OrderDetail::updateOrCreate(
                                                    ['product_id' => $product->id,
    
                                                        'order_id' => $order->id,
                                                    ], [
                                                        'product_name' => $product->name_en,
                                                        'price' => $product->price(),
                                                        'quantity' => (int) $qty[$index],
                                                    ]);
    
                                            }
    
                                            $title = __('messages.success');
                                            $status = 'success';
                                            $msg = __('messages.add order success');
                                            $redirect =route('checkout');
                                        } else {
                                           
                                            $title = __('messages.error');
                                            $status = 'error';
                                            $msg = __('messages.coupon not exist');
                                            $redirect = route('checkout');
                                        }
                                    } else {
                              
                                        $title = __('messages.error');
                                        $status = 'error';
                                        $msg = __('messages.your coupon is expired');
                                        $redirect = route('checkout');
                                    }
                                }else{
                                    $title = __('messages.error');
                                    $status = 'error';
                                    $msg = __('messages.your invoice total less than coupon value');
                                    $redirect = route('checkout'); 
                                }
                               
                            } else {
                                $title = __('messages.error');
                                $status = 'error';
                                $msg = __('messages.your coupon have been used recently');
                                $redirect = route('checkout');
                            }

                        } else {
                            $title = __('messages.error');
                            $status = 'error';
                            $msg = __('messages.your coupon is not correct');
                            $redirect = route('checkout');
                        }

                    } else if (!isset($coupon) && empty($coupon)) {
                        $title = __('messages.error');
                        $status = 'error';
                        $msg = __('messages.coupon not exist');
                        $redirect = route('checkout');

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
                      
                        'city' => $request->city,
                        'notes' => $request->notes,
                        'status' => 'Checkout',
                        'total' => $request->total,
                        'total_after_discount' => null,

                        'coupon_value' => null,
                        'order_date' => now(),
                    ]);
                
                    foreach ($products as $index => $product) {
                        if (isset($qty[$index])) {
                       
                            $order_d= OrderDetail::updateOrCreate(
                                ['product_id' => $product->id,
    
                                    'order_id' => $order->id,
                                ], [
                                    'product_name' => $product->name_en,
                                    'price' => $product->price(),
                                    'quantity' => (int) $qty[$index], // Match quantity by index
                                ]);
                             
                            }
                       
                    }

                    $title = __('messages.success');
                    $status = 'success';
                    $msg = __('messages.add order success');
                    $redirect = route('checkout');
                }
            }
            //  else{
            //    dd(2);
            //     $title = __('messages.error');
            //     $status = 'error';
            //     $msg = __('messages.please add products to your cart');
            //     $redirect = route('shop');
            // }
            DB::commit();
            return response()->json(['title' => $title, 'message' => $msg, 'status' => $status, 'redirect' => $redirect]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }

}
