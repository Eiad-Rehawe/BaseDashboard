<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;
trait uploadImage
{

    public function uploads($file, $path)
    {
        if ($file) {
            $url = explode('/',request()->url());           
      
            $file_name  = $file->hashName();
            $file_type  = $file->getClientOriginalExtension();
            // $full_path = asset('/uploads/'.$path); 
            $full_path = public_path('/uploads/'.$path);

            // Check if the directory exists, if not, create it
           
            $file->move($full_path,$file_name);
            // Storage::disk('public')->put($path . $file_name, $image);
          


            return $file = [
                'fileName' => $file_name,
                'fileType' => $file_type,
                'filePath' => $url[0] . $url[2] . '/uploads/'.$path,
                // 'fileSize' => $this->fileSize($file),
                // 'pdf'      =>$pdf
            ];

            
        }
    }

    public function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();

        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }



    public function removeFile($file, $folder)
    {
        if (File::exists('public/images/' . $folder . '/' . $file)) {
            unlink('public/images/' . $folder . '/' . $file);
        }
    }

    public function dropzoneStore($file){
        $image = $file;
        $imageName = date("dHis-").preg_replace("/[^a-zA-Z0-9.]/","",$image->getClientOriginalName());
        $uploadPath = public_path('up/').date("Y/m");
        $image->move($uploadPath,$imageName);
        //Thumbnail Creation
        $thumbPath = $uploadPath.'/thumbs/';
        File::isDirectory($thumbPath) or File::makeDirectory($thumbPath,0775,true,true);
        if($image->getClientOriginalExtension() != 'svg'){
            $imageThmb = Image::make($uploadPath.'/'.$imageName);
            $imageThmb->fit(300,300,function($constraint){$constraint->upsize();})->save($uploadPath.'/thumbs/thm_'.$imageName,80);
        }else{
            File::copy($uploadPath.'/'.$imageName,$uploadPath.'/thumbs/thm_'.$imageName);
        }
        return $imageName;
    }
}