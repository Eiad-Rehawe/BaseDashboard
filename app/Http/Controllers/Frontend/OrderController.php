<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function my_orders()
    {
        try {
            $orders = Order::where('user_id',auth()->id())->whereHas('details')->get();
            $order = Order::where('user_id',auth()->id())->first();
            $first_order_details=[];
            if(!empty($order)){
                $first_order_details = OrderDetail::whereHas('order')->where('order_id',$order->id)->get();
              
            }
            return view('pages.orders',compact('orders','first_order_details'));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getDetails(Request $request)
    {
        try {
            $details = OrderDetail::where('order_id',$request->order_id)->get();
         
            return response()->json([
              
                'html' => view('pages.orders.details', ['details' => $details])->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function deleteProductOrder(Request $request)
    {
        try {
            $order = Order::where('id',$request->order_id)->where('status','!=','Accept')->first();
            if(!$order){
                return response()->json(['title' => __('messages.error'), 'message' => __("messages.you_cant_edit_this_order"), 'status' => 'error','redirect'=>route('my_orders')]);
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
          return response()->json(['title' => __('messages.success'), 'message' => __('messages.delete success'), 'status' => 'success']);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function deleteOrder(Request $request)
    {
        try {
            
            $order = Order::where('id',$request->order_id)->where('status','!=','Accept')->first();
            if(!$order){
                return response()->json(['title' => __('messages.error'), 'message' => __("messages.you_cant_edit_this_order"), 'status' => 'error','redirect'=>route('my_orders')]);
            }
          $details = OrderDetail::where('order_id',$request->order_id)->delete();
        
          $order->delete();
          return response()->json(['title' => __('messages.success'), 'message' => __('messages.delete success'), 'status' => 'success']);

        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }
    public function editOrder(Request $request)
    {
        try {
            $data = OrderDetail::where('id',$request->id)->first();
            // dd($data);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function updateOrder(OrderRequest $request)
    {
        try {
           $order = Order::where('id',$request->id)->where('status','!=','Accept')->first();

         if(!$order){
            return response()->json(['title' => __('messages.error'), 'message' => __("messages.you_cant_edit_this_order"), 'status' => 'error','redirect'=>route('my_orders')]);

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
        

           return response()->json(['title' => __('messages.success'), 'message' => __('messages.update success'), 'status' => 'success','redirect'=>route('my_orders')]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }  
    }

    public function addProductsToOrder(OrderRequest $request)
    {
     
        try{
            $order = Order::where('id',$request->id)->where('status','!=','Accept')->first();

            if(!$order){
               return response()->json(['title' => __('messages.error'), 'message' => __("messages.you_cant_edit_this_order"), 'status' => 'error','redirect'=>route('my_orders')]);
   
            }
         
            $products = explode(',',$request->product_id);
            $qtys = explode(',',$request->qty);
            $products = Product::whereIn('id',$products)->get();
            foreach ($products as $index=>$product) {
                $quantity = $qtys[$index];
             
                OrderDetail::updateOrCreate(
                    ['product_id' => $product->id,

                        'order_id' => $order->id,
                    ], [
                        'product_name' => $product->name_en,
                        'price' => $product->price(),
                        'quantity' => (int)$quantity,
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
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.save success'), 'status' => 'success','redirect'=>route('my_orders')]);

      
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        } 
    }
}
