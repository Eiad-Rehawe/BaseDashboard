<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Display Orders|عرض الطلبات'], ['only' => ['index', 'show']]);

    }
    public function index()
    {
        $data = Order::orderBy('id','desc')->get();
        
        return view('backend.orders.index',compact('data'));
    }
    public function updateStatus($id, $column)
    {
        try {

            $row = Order::where('id', $id)->first();
            $details = $row->details;
            foreach($details as $detail){
                if($detail->quantity <= $detail->product->quantity &&  $detail->product->quantity > 0){
                    $quantity =$detail->product->quantity-$detail->quantity;
                    $detail->product()->update(['quantity'=>$quantity]);
                    $row->update(['status' => 'Accept']);
                    return response()->json(['title' => __('messages.success'), 'message' => __('messages.update success'), 'status' => 'success']);
                }else{
                    $row->update(['status' => 'Reject']);

                    return response()->json(['title' => __('messages.error'), 'message' => __('messages.The quantity exceeds the available stock'), 'status' => 'error']);

                }
            }
           
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function updateStatusReject($id, $column)
    {
        try {

            $row = Order::with('details')->where('id', $id)->first();
            $row->update(['status' => 'Reject']);
          
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.update success'), 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
