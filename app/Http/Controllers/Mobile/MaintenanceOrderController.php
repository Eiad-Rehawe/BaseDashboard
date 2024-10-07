<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Requests\MaintenanceOrderRequest;
use App\http\Controllers\Controller;
use App\Models\MaintenanceOrder;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class MaintenanceOrderController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addMaintenanceOrder(MaintenanceOrderRequest $request)
    {
        try {
            MaintenanceOrder::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'province' => $request->province,
                'region' => $request->region,
                'address' => $request->address,
                'problem_cause' => $request->problem_cause,
                'description' => $request->description
            ]);
            return $this->returnSuccess(__('messages.add order success'),200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceOrder $maintenanceOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceOrder $maintenanceOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceOrder $maintenanceOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceOrder $maintenanceOrder)
    {
        //
    }
}
