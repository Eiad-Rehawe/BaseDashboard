<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CouponsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Http\Services\CouponService;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class CouponsController extends BackendController
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CouponsDataTable $dataTable,Coupon $data)
    {
        // $this->middleware(['permission:Display Coupons|Update Coupons|Delete Coupons|عرض الكوبونات|إضافة كوبون|تعديل كوبون|Create Coupon|حذف كوبون'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Coupon|إضافة كوبون'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Update Coupon|تعديل كوبون'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Coupon|حذف كوبون'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$data);
    }

    public function append()
    {
   
        return[
           'users'=>User::where('status',1)->get(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request, CouponService $service)
    {
      
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.coupons.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request,$id, CouponService $service)
    {
        try {
            $row = $service->handle($request->all(),$id);
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.coupons.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
