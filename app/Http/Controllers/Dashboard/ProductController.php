<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\Size;
use App\Models\WeightMeasurement;
use App\Traits\uploadImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Spatie\Permission\Models\Permission;

class ProductController extends BackendController
{
    use uploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProductsDataTable $dataTable,Product $admin)
    {
        // $this->middleware(['permission:Display Products|عرض المنتجات|إضافة منتج|تعديل منتج|حذف منتج|Update Product|Delete Product'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Product|إضافة منتج'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Update Product|تعديل منتج'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Product|حذف منتج'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$admin);
    }

    public function append()
    {
   
        return[
            'rows' => (new Category())->getDataAsLang()->where('status', 1)->get(),
            'w_ms'=>(new WeightMeasurement())->getDataAsLang()->get(),
            'sizes'=>Size::all(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductService $service)
    {
        try {
            $row = $service->handle($request->all());
            if (is_string($row)) return $this->throwException($row);
            $row->size_id = $request->input('size_id');
            $row->save();

            return response()->json(['title' => 'success', 'message' => 'create success', 'status' => 'success', 'redirect' => route('backend.products.index')]);
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
    public function update(ProductRequest $request,$id, ProductService $service)
    {
        try {
            $row = $service->handle($request->all(),$id);
            if (is_string($row)) return $this->throwException($row);
            $row->size_id = $request->input('size_id');
            $row->save();

            return response()->json(['title' => 'success', 'message' => 'update success', 'status' => 'success', 'redirect' => route('backend.products.index')]);
        }
        catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function qr_code_generate(Request $request,$id)
    {
        try {
            $row = Product::where('id',$id)->first();
            $barcode_id = $row->barcode_id;
            $barcode = new DNS1D();
        $barcodeHtml = $barcode->getBarcodeHTML($barcode_id, 'C39');
            $url = "http://localhost:8000/product/" . $row->id;
           $count = $request->count;
            
            return view('pdf.qr_code',compact('row','count','url','barcodeHtml'));
          
    
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}