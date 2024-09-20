<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    use ResponseTrait;
    public function my_orders()
    {
        try {
            $lang = request()->header('Accept-Language');
            $data = Order::where('user_id',auth()->id())->with('details',function($q) use($lang){
                $q->with('product', function ($q) use ($lang) {
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
    
                });
            })->whereHas('details')->get();
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function deleteProductOrder(OrderRequest $request)
    {
        
        try {
          
            $order = Order::where('id',$request->order_id)->where('status','!=','Accept')->first();
        
            if(!$order){
                return $this->returnError( __('messages.you_cant_edit_this_order'),403);

            }
          $detail = OrderDetail::where('order_id',$request->order_id)->where('product_id',$request->product_id )->first();
      
          $detail->delete();
          if($order->coupon_id == ''){
            $order->update([
                'total'=>$order->total-($detail->quantity * $detail->price)
            ]);
          }
          if($order->coupon_id != ''){
            $order->update([
                'total'=>$order->total-($detail->quantity * $detail->price),
                'total_after_discount'=>$order->total-($detail->quantity * $detail->price)
            ]);
          }
          $dd = $order->details->toArray();
          if(empty($dd)){
            $order->delete();
          }
          return $this->returnSuccess( __('messages.delete success'),200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function deleteOrder(Request $request)
    {
        try {
            
            $order = Order::where('id',$request->order_id)->where('status','!=','Accept')->first();
            if(!$order){
                return $this->returnError( __('messages.you_cant_edit_this_order'),403);
            }
          $details = OrderDetail::where('order_id',$request->order_id)->delete();
        
          $order->delete();
          return $this->returnSuccess( __('messages.delete success'),200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }
  
    public function updateOrder(OrderRequest $request)
    {
       
        try {
          
           $order = Order::where('id',$request->id)->where('status','!=','Accept')->first();

         if(!$order){
            return $this->returnError( __('messages.you_cant_edit_this_order'),403);

         }
           $details = $order->details()->where('product_id',$request->product_id)->update([
            'quantity'=>$request->qty
           ]);
           $details= OrderDetail::where('order_id',$order->id)->get();
           $totalPrice = $details->sum(function($orderDetail) {
               return $orderDetail->quantity * $orderDetail->price;
           });
           if($order->coupon_id == ''){
            $order->update([
                'address_1'=>$request->address_1,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'notes'=>$request->notes,
                'total'=>$totalPrice
               ]);
    
           }else{
            $coupon = Coupon::where('id',$order->coupon_id)->first();
            $order->update([
                'address_1'=>$request->address_1,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'notes'=>$request->notes,
                'total'=>$totalPrice,
                'total_after_discount'=>$totalPrice - $coupon->value
               ]);
           }
        

           return $this->returnSuccess(__('messages.update success'),200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }  
    }

    public function addProductsToOrder(OrderRequest $request)
    {
        try{
            $order = Order::where('id',$request->id)->where('status','!=','Accept')->first();

            if(!$order){
                return $this->returnError( __('messages.you_cant_edit_this_order'),403);
   
            }
           
           $products = Product::whereIn('id',(array)$request->product_id)->get();
            foreach($products as $index=>$product){
               
                OrderDetail::updateOrCreate(
                    ['product_id' => $product->id,
        
                        'order_id' => $order->id,
                    ], [
                        'product_name' => $product->name_en,
                        'price' => $product->price(),
                        'quantity' => (int) $request->qty[$index], // Match quantity by index
                    ]);
            }
           $details= OrderDetail::where('order_id',$order->id)->get();
            $totalPrice = $details->sum(function($orderDetail) {
                return $orderDetail->quantity * $orderDetail->price;
            });
            if($order->coupon_id == ''){
            $order->update([
                'total'=>$totalPrice
            ]);
        }else{
            $coupon = Coupon::where('id',$order->coupon_id)->first();
            $order->update([
                'total'=>$totalPrice,
                'total_after_discount'=>$totalPrice - $coupon->value
            ]);
        }
        return $this->returnSuccess(__('messages.create success'),200);
      
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        } 
    }
}