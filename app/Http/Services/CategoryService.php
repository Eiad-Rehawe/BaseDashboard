<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\File;
use App\Traits\uploadImage;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    use uploadImage;
    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();
            $row = '';
            $files = $request['image'] ?? '';
          
            $row = Category::updateOrCreate(['id' => $id], $request);
           
             if (!empty($files)) {
                $files_ = $row->files;
                if (isset($files_)) {
                    foreach ($files_ as $img) {

                        $img->delete();
                    }
                }
                foreach ($files as $file) {
                    $fileData = $this->uploads($file, '/categories/');
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
