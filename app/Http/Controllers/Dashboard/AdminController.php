<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AdminsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Services\AdminService;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;    

class AdminController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(AdminsDataTable $dataTable,Admin $admin)
    {
       
        // $this->middleware(['permission:Display Employees|عرض الموظفين|Update Employee|تعديل موظف|Delete Employee|حذف موظف'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Employee|إضافة موظف'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Update Employee|تعديل موظف'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Employee|حذف موظف'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$admin);
    }

   public function append()
   {
        $lang = app()->getLocale();
        return[
            'data'=>DB::table('permissions')->join('languages','languages.id','=','permissions.lang_id')->select('permissions.id','permissions.permission_id','permissions.name')
                                            ->where('languages.short_name',request()->segment(1))->get(),
            'roles'=>(new Role())->where('name_en','!=','manager')->select('id',"name_$lang as name",'guard_name')->get()   
                                                
        ];
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request,AdminService $service)
    {
        try{
            $row = $service->handle($request->input());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.admins.index')]);

        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request,AdminService $service,$id)
    {
        try{
        
            $row = $service->handle($request->input(),$id);
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.admins.index')]);

        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }

    public function update_password(AdminRequest $request,AdminService $service)
    {
        try{
            $id = auth()->id();
            $row = $service->change_password($request->input(),$id);
            if (is_string($row)) return $this->throwException($row);    
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.saved success'), 'status' => 'success', 'redirect' => route('backend.admins.index')]);

        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    public function getPermissions(Request $request)
    {
        try {
            $data2_ = DB::table('permissions')
            ->join('languages','languages.id','=','permissions.lang_id')
            ->select('permissions.id','permissions.permission_id','permissions.name')
            ->where('languages.short_name',$request->segment(1))
            ->get();
            $data= DB::table('permissions')->join('languages','languages.id','=','permissions.lang_id')->select('permissions.id','permissions.permission_id','permissions.name')
                                            ->where('languages.short_name',$request->segment(1))->get();
            return response()->json([
                'data2_' =>$data2_,
                'data'=>$data,
                'html'  => view('backend.admins.permissions', ['data2_' =>$data2_,'data'=>$data])->render()
            ]);
        }catch(\Exception $e){
            dd($e);
            return response()->json($e->getMessage(), 500);
        }
    }
}
