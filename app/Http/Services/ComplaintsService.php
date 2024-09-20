<?php
namespace App\Http\Services;

use App\Http\Traits\ResponseTrait;
use App\Models\Admin;
use App\Models\Complaints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\ElseIf_;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ComplaintsService{

  
    public function handle($request,$id = null)
    {
 
        try {
     
        DB::beginTransaction();
        if(auth()->guard('admin') && request()->segment(2) == 'admin'){
           
            $request['employee_id']=auth('admin')->id();
      
            $request['customer_id']=null;
        }if(auth()->guard('web')){
            $request['customer_id']=auth()->id();
            // $request['employee_id']=null;
        }
        if(isset($request['product_id'])){
            $request['status'] = 2;
        }
        $request['complaint_date']=now();
        $row = Complaints::updateOrCreate(['id' => $id], $request);
        DB::commit();
        return $row;
    } catch (\Exception $e) {
        dd($e);
        DB::rollBack();
        return response()->json($e->getMessage(), 500);
    }
    }
}
