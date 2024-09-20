<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\ComplaintsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintsRequest;
use App\Http\Services\ComplaintsService;
use App\Models\Complaints;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
   
    public function store(ComplaintsRequest $request,ComplaintsService $service)
    {
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' =>  __('messages.saved success'), 'status' => 'success', 'redirect' => route('front.product',$request->product_id)]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function storePublicOrEmployeeComplaiment(ComplaintsRequest $request)
    {
        try{
            Complaints::create(array_merge($request->except('customer_id','complaint_date'),['customer_id'=>auth()->id(),'complaint_date'=>now()]));

            return response()->json(['title' => __('messages.success'), 'message' =>  __('messages.saved success'), 'status' => 'success', 'redirect' => route('complaiment')]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e->getMessage());
        }
    }
}
