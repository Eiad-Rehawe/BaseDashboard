<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(RolesDataTable $dataTable,Role $role)
    {
        // $this->middleware(['permission:Display Roles|Create Role|Update Role|Delete Role|عرض الصلاحيات|إضافة صلاحية|تعديل صلاحية|حذف صلاحية'], ['only' => ['index', 'show']]);
        // $this->middleware(['permission:Create Role|إضافة صلاحية'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:Update Role|تعديل صلاحية'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:Delete Role|حذف صلاحية'], ['only' => ['destroy']]);
        // $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);

        parent::__construct($dataTable,$role);
    }

    public function append()
    {
        return[
            'data'=>DB::table('permissions')->join('languages','languages.id','=','permissions.lang_id')->select('permissions.id','permissions.permission_id','permissions.name')
            ->where('languages.short_name',request()->segment(1))->get(),
            'langs'=>Language::get()
        ];
    }
   
    public function store(RoleRequest $request,RoleService $service)
    {
        try{
            // foreach (auth()->user()->roles as $role) {
            //     if (!$role->hasPermissionTo('Create Role') || !$role->hasPermissionTo('إضافة صلاحية') ) {
            //         return $this->returnError('unauthorized', 403);
            //     }
            // }
            $row = $service->handle($request->input());
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => 'success', 'message' => 'create success', 'status' => 'success', 'redirect' => route('backend.roles.index')]);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }

    public function update(RoleRequest $request,RoleService $service,$id)
    {
        try{
            // foreach (auth()->user()->roles as $role) {
            //     if (!$role->hasPermissionTo('Update Role') || !$role->hasPermissionTo('تعديل صلاحية') ) {
            //         return $this->returnError('unauthorized', 403);
            //     }
            // }
            $row = $service->handle($request->input(),$id);
            if (is_string($row)) return $this->throwException($row);
            return response()->json(['title' => 'success', 'message' => 'update success', 'status' => 'success', 'redirect' => route('backend.roles.index')]);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }


}
