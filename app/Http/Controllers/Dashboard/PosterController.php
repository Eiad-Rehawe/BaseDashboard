<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PostersDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\PosterRequest;
use App\Http\Services\PosterService;
use App\Models\Category;
use App\Models\Language;
use App\Models\Poster;
use App\Models\Product;
use Illuminate\Http\Request;

class PosterController extends BackendController
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(PostersDataTable $dataTable, Poster $data)
    {
        // $this->middleware(['permission:Display Offers|عرض العروض|Update Offer|تعديل العرض|حذف العرض|إضافة العرض|Delete Offer'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Offer|إضافة العرض'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Update Offer|تعديل العرض'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Offer|حذف العرض'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible|حذف متعدد'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable, $data);
    }

    public function append()
    {
        
        return [
            'rows' => (new Category())->getDataAsLang()->where('status', 1)->get(),
            'products_rows' => (new Product())->getDataAsLang()->where('status', 1)->get(),
            
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosterRequest $request, PosterService $service)
    {
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) {
                return $this->throwException($row);
            }

            return response()->json(['title' => 'success', 'message' => 'create success', 'status' => 'success', 'redirect' => route('backend.offers.index')]);
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
    public function update(PosterRequest $request, $id, PosterService $service)
    {
        try {
            $row = $service->handle($request->all(), $id);
            if (is_string($row)) {
                return $this->throwException($row);
            }

            return response()->json(['title' => 'success', 'message' => 'update success', 'status' => 'success', 'redirect' => route('backend.offers.index')]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function price(Request $request)
    {
       $row = Product::where('id',$request->product_id)->first();
        if($row->selling_price < $request->price_discount)
        {
            return response()->json(['msg'=>__('price should less than '.$row->selling_price)]);
        }
    }
}
