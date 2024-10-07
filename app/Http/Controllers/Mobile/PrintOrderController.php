<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrintOrderRequest;
use App\Models\PrintOrder;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PrintOrderController extends Controller
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
    public function addPrintOrder(PrintOrderRequest $request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imageName = time().'.'.$image->getClientOriginalExtension();

                $image->move(public_path('uploads/print'), $imageName);
            
                PrintOrder::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'province' => $request->province,
                    'region' => $request->region,
                    'address' => $request->address,
                    'print_size_id' => $request->print_size_id,
                    'quantity' => $request->quantity,
                    'image' => $imageName
                ]);
                return $this->returnSuccess(__('messages.saved success'), 200);
            }
            return $this->returnError(__('messages.Error file'), 500);
        }catch (\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrder $printOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintOrder $printOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder)
    {
        //
    }
}
