<?php
namespace App\Http\Services;

use App\Models\File;
use App\Models\Product;
use App\Traits\uploadImage;
use Illuminate\Support\Facades\DB;

class ProductService
{
    use uploadImage;
    public function handle($request, $id = null)
    {

        try {
            DB::beginTransaction();
            $row = '';
            $files = $request['image'] ?? '';

            $row = Product::updateOrCreate(['id' => $id], $request);

            if (!empty($files)) {
                $files_ = $row->files;
                if (isset($files_)) {
                    foreach ($files_ as $img) {

                        $img->delete();
                    }
                }
                foreach ($files as $file) {
                    
                    $fileData = $this->uploads($file, '/products/');
                    $row->files()->create([
                        'name' => $fileData['fileName'],
                        'path' => $fileData['filePath'],
                    ]);
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
