<?php
namespace App\Http\Services;

use App\Models\Category;
use App\Models\Poster;
use App\Models\Product;
use App\Traits\uploadImage;
use Illuminate\Support\Facades\DB;

class PosterService{
    use uploadImage;
    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();
           
            $row = Poster::updateOrCreate(['id' => $id], $request);
            if(!empty($request['price_discount']) ){
                $product = Product::where('id',$request['product_id'])->first();
                $product->new_selling_price = $product->selling_price - $request['price_discount'];
                $product->update(['new_selling_price'=>$product->new_selling_price]);
            }
            if(!empty($request['Percentage_discount'])  ){
                $category = Category::where('id',$request['category_id'])->first();
                $products = Product::where('category_id',$request['category_id'])->get();
                foreach($products as $product){
                    $product->new_selling_price = $product->selling_price -($product->selling_price * $request['Percentage_discount']/100);
                    $product->update(['new_selling_price'=>$product->new_selling_price]);
                }
               
            }
        
            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return $e->getMessage();
        }
    }
}