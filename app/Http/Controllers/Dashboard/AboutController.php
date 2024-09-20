<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Traits\uploadImage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use uploadImage;
    public function index()
    {
        $row =About::first();
        return view('backend.abouts.form',compact('row'));
    }

    public function store(AboutRequest $request)
    {
        try{
            $fileData = $this->uploads($request->image, '/abouts/');
            $row = About::first();
            if($row){
                $row->update(['descrption_en'=>$request->descrption_en,'descrption_ar'=>$request->descrption_ar,'image'=>$fileData['fileName']]);

            }
            About::create(['descrption_en'=>$request->descrption_en,'descrption_ar'=>$request->descrption_ar,'image'=>$fileData['fileName']]);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.abouts.index')]);

        }catch(\Exception $e)
        {
            return response()->json($e->getMessage(),500);

        }
    }
}
